const incrementCartItemQuantity = (cartItemId) => {
    if (!checkCurrentCartItemQuantity(cartItemId)) {
        handleCartItemQuantityInvalid(cartItemId);
        return;
    }
    changeCartItemQuantity(cartItemId, 1);
};

const decrementCartItemQuantity = (cartItemId) => {
    if (!checkCurrentCartItemQuantity(cartItemId)) {
        handleCartItemQuantityInvalid(cartItemId);
        return;
    }
    changeCartItemQuantity(cartItemId, -1);
};

const onCartItemQuantityChange = (cartItemId) => {
    if (!checkCurrentCartItemQuantity(cartItemId)) {
        handleCartItemQuantityInvalid(cartItemId);
        return;
    }
    submitUpdateCartItemQuantityForm(cartItemId);
};

const changeCartItemQuantity = (cartItemId, quantityToAdd) => {
    const confirmAnswer = confirm(
        "Are you sure you want to change the quantity of an item in the cart?"
    );
    if (!confirmAnswer) {
        return;
    }

    const cartItemQuantityElement = document.getElementById(
        "cartItemQuantityInput" + cartItemId
    );
    const currentQuantity = parseInt(cartItemQuantityElement.value);
    if (currentQuantity + quantityToAdd < 1) {
        alert("Cannot change quantity to " + (currentQuantity + quantityToAdd));
        setCurrentCartItemQuantityToOriginalQuantity(cartItemId);
        return;
    }
    cartItemQuantityElement.value = currentQuantity + quantityToAdd;
    submitUpdateCartItemQuantityForm(cartItemId);
};

const submitUpdateCartItemQuantityForm = (cartItemId) => {
    const updateCartItemQuantityForm = document.getElementById(
        "updateCartItemQuantityForm" + cartItemId
    );
    updateCartItemQuantityForm.submit();
};

const checkCurrentCartItemQuantity = (cartItemId) => {
    const cartItemQuantityElement = document.getElementById(
        "cartItemQuantityInput" + cartItemId
    );
    return parseInt(cartItemQuantityElement.value) > 0;
};

const handleCartItemQuantityInvalid = (cartItemId) => {
    alert("The quantity is invalid");
    setCurrentCartItemQuantityToOriginalQuantity(cartItemId);
};

const setCurrentCartItemQuantityToOriginalQuantity = (cartItemId) => {
    const originalCartItemQuantityElement = document.getElementById(
        "originalItemQuantityInput" + cartItemId
    );
    const originalQuantity = parseInt(originalCartItemQuantityElement.value);

    const cartItemQuantityElement = document.getElementById(
        "cartItemQuantityInput" + cartItemId
    );
    cartItemQuantityElement.value = originalQuantity;
};
