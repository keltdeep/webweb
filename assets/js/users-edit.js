let form = document.getElementById("user-edit-form");
let userIdInput = document.getElementById('user-id');
let hasActiveCheckbox = !!document.getElementById('exampleCheck1');

function getUserFormData() {
    let formData = new FormData(form);
    let userAttributes = {};
    formData.forEach(function (value, key) {
        userAttributes[key] = value;
    });

    if (hasActiveCheckbox) {
        userAttributes.active = userAttributes.active === 'on';
    }
    console.log(userAttributes);
    
    return userAttributes;
}


function editUser(userAttributes) {
    $.post("/api/users/" + userIdInput.value, userAttributes, () => {
        location.reload();
    });
    
}

function createUser(userAttributes) {
    
    $.post("/api/users", userAttributes, (user) => {
        
        location.pathname = '/users/' + user.id;
    });
    
}
