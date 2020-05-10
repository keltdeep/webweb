
let getButtonRegistration = document.getElementById("buttonRegistration");
let feedBack = document.getElementById("feed-back");
let userFeedBack = document.getElementById("user-Feed-Back");


function addFeedBack(feedback) {
    let usersFeedBacks = getFeedBack() || [];
    console.log(usersFeedBacks);
    usersFeedBacks.push(feedback);

    localStorage.setItem("usersFeedBacks", JSON.stringify(usersFeedBacks));
}

function getFeedBack() {

    return JSON.parse(localStorage.getItem("usersFeedBacks"));
}


function displayFeedBacks (container, feedbacks) {
    container.innerHTML = "";
    feedbacks.forEach(function (feedback) {
        let feedbackElement = document.createElement("div");
        feedbackElement.innerHTML = "<h3>" + feedback.name + "</h3>"+
            "<div>" + feedback.phone + " " + feedback.email +"</div>" +
            "<br>" + "<div class='userMassage'>" + feedback.massage + "</div>" ;
        container.appendChild(feedbackElement);
    })
}

feedBack.addEventListener("submit",
    function (e) {
    e.preventDefault();
let formData = new FormData(feedBack);
let infoFeedBack = {
    "name": formData.get("name"),
    "phone": formData.get("phone"),
    "email": formData.get("email"),
    "massage": formData.get("massage")
};
alert("thanks for feedback");

addFeedBack(infoFeedBack);

displayFeedBacks(userFeedBack, getFeedBack());
});

displayFeedBacks(userFeedBack, getFeedBack());
