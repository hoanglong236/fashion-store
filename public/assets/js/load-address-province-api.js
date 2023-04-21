const fetchProvinceApiData = async () => {
    const provinceApiUrl = "https://provinces.open-api.vn/api/?depth=3";
    const ajaxRequest = $.ajax({
        method: "GET",
        async: true,
        url: provinceApiUrl,
        error: function () {
            alert(
                "Could not load province information. Please refresh the page and try again."
            );
        },
    });
    return ajaxRequest.done((data) => {
        return data;
    });
};

const getDistrictObjectsFromCityObjectsByCityName = (cityObjects, cityName) => {
    for (const cityObj of cityObjects) {
        if (cityObj.name === cityName) {
            return cityObj.districts;
        }
    }
    return [];
};

const getWardObjectsFromDistrictObjectsByDistrictName = (
    districtObjects,
    districtName
) => {
    for (const districtObj of districtObjects) {
        if (districtObj.name === districtName) {
            return districtObj.wards;
        }
    }
    return [];
};

const createOptionElement = (value, text) => {
    const optionElement = document.createElement("option");

    optionElement.innerHTML = text;
    optionElement.value = value;

    return optionElement;
};

const resetCitySelectElement = () => {
    $("#citySelect").empty();
    $("#citySelect").append(createOptionElement("", "==== Select a city ===="));
};

const loadCitySelectElement = (data) => {
    for (const cityObj of data) {
        $("#citySelect").append(
            createOptionElement(cityObj.name, cityObj.name)
        );
    }

    $("#citySelect").on("change", () => loadDistrictSelectElement(data));
};

const resetDistrictSelectElement = () => {
    $("#districtSelect").empty();
    $("#districtSelect").append(
        createOptionElement("", "==== Select a district ====")
    );
};

const loadDistrictSelectElement = (cityObjects) => {
    const cityName = $("#citySelect").val();
    const districtObjects = getDistrictObjectsFromCityObjectsByCityName(
        cityObjects,
        cityName
    );

    resetDistrictSelectElement();
    for (const districtObj of districtObjects) {
        $("#districtSelect").append(
            createOptionElement(districtObj.name, districtObj.name)
        );
    }

    $("#districtSelect")
        .off("change")
        .on("change", () => loadWardSelectElement(districtObjects));
    resetWardSelectElement();
};

const resetWardSelectElement = () => {
    $("#wardSelect").empty();
    $("#wardSelect").append(createOptionElement("", "==== Select a ward ===="));
};

const loadWardSelectElement = (districtObjects) => {
    const districtName = $("#districtSelect").val();
    const wardObjects = getWardObjectsFromDistrictObjectsByDistrictName(
        districtObjects,
        districtName
    );

    resetWardSelectElement();
    for (const wardObj of wardObjects) {
        $("#wardSelect").append(
            createOptionElement(wardObj.name, wardObj.name)
        );
    }
};

const loadAddressSelectElements = async () => {
    resetCitySelectElement();
    resetDistrictSelectElement();
    resetWardSelectElement();

    const data = await fetchProvinceApiData();
    loadCitySelectElement(data);
};

loadAddressSelectElements();
