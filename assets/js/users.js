let usersListContainer = document.getElementById('users-list');
let paginationContainer = document.getElementById('pagination');
let createUserLink = document.getElementById("create-user-link");

let params = {
    "limit": 9,
    "offset": 0
};

function paginationUsers(limit, offset) {
   
let i = offset;

paginationContainer.innerHTML = "";

createUserLink.innerHTML = `<div><a href="/users/create" class="btn btn-success">Create new User</a></div>`
    if (i>=1) {
        paginationContainer.innerHTML +=`
        <div class="page-item"><span
        class = "page-link"
        data-limit = "${limit}"
        data-offset = "${offset-1}"
        >previous</span></div>`
}

for (i=offset - 3; i < offset + 3; i++) {
    
    if (i>=0){
    
        paginationContainer.innerHTML += `
        <div 
        class="page-item"><span
        class = "page-link"
        data-limit = "${limit}"
        data-offset = "${i}">${i+1}</span></div>`
    }
}
    if(offset<=i){
        paginationContainer.innerHTML +=`
        <div 
        class="page-item"><span
        class = "page-link"
        data-limit = "${limit}"
        data-offset = "${offset+1}">next</span></div>`
        }
    }

function getUsers(limit, offset) {
    return $.get("/api/users", {limit, offset});
}


    function usersViewHTML(users) {
        
        let usersList = '';
        users.forEach(user => { if(user["active"]== true) {
        
        usersList  += `
            <div class="card" style="width: 18rem;">
           
                <img src="${user.image}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">${user.login}</h5>
                    <p class="card-text">info</p>
                    <a href="/users/${user.uuid}" class="btn btn-success">View</a>
                    </form>
                </div>
            </div>`;
    }});

    return usersList;
}
    


function renderUsers(limit, offset) {
    getUsers(limit, offset).then((users) => {
        let usersHTML = usersViewHTML(users);
        usersListContainer.innerHTML = usersHTML;
        paginationUsers(limit, offset);
    });
}

$(".pagination-container").on('click', function(e) {
    if($(e.target).data().offset == undefined) {

    }
    else {
        let params = $(e.target).data();
        renderUsers(params.limit, params.offset);
        params['offset'] = params.offset
    }
    
});

renderUsers(params.limit, params.offset);
