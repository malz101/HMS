// const URLROOT='http://localhost/COMP2171/HMS';
// $(document).ready(function () {
//     index();
//     $('.submit-button').click
//     (function (event) {
//         event.preventDefault();
//         let id_ = $('#name').val();
//         let password_ = $('#email').val();
//         //console.log('hello');
//         $.ajax(URLROOT+"/users/login", {
//             type: "POST",
//             data: {
//                 id: id_,
//                 password: password_
//             }
//         }).done(function (response) {
//             let resObj = JSON.parse(response);
//             const main = document.querySelector("main");
//             console.log(resObj.loggedIn);
//             if (resObj.loggedIn === -1) {
//                 $('#alertbox').html(resObj.message);
//                 $('.w-form-fail').show();
//             } if (resObj.loggedIn === 1) {
//                 $('#alertbox').html("Login Successful");
//                 console.log();
//                 main.innerHTML=resObj.message;
//                 //window.location.replace(resObj.message);
//             } if (resObj.loggedIn === 0) {
//                 $('#alertbox').html(resObj.message);
//                 $('.w-form-fail').show();
//             }
//         }).fail(function () {
//             alert('Something went wrong with a request to the server');
//         });
//     });


//     $('#continue-button').click(function () {
//         request('/resident/confirmation');
//     });

//     $('.sign-out').click(function () {
//         request('/users/logout');
//     });

//     $('#log-issue').click(function () {
//         request('/resident/logIssue');
//     });

//     $('#track-issue').click(function () {
//         request('/resident/trackIssue');
//     });

//     $('#track-issue-1').click(function (event) {
//         event.preventDefault();
//         let idnum = $('#track-idNum').val();
//         let data_ = {IDnum: idnum};
//         request('/issues/show-issues',data_);
//     });


//     $('#submit-issue').click(function (event) {
//         event.preventDefault();
//         let clust = $('#cluster').val();
//         let cat = $('#classification').val();
//         let desc = $('#Issue-description').val();
//         let idN = $('#IDapp').val();

//         let data_ = {
//             residentID: idN,
//             cluster: clust,
//             classification: cat,
//             description: desc
//         }

//         request('/issues/resSubIssue', data_);
//     });



//     $('#give-feedback').click(function(event) {
//         event.preventDefault(); 
//         let Iid = $('#isseue-id').val();
//         let Id = $('#ID-number').val();
//         let desc = $('#Issue-description').val();
//         let data_ = {
//             issueID: Iid,
//             ID: Id,
//             description: desc
//         }

//         request('/feedback/giveFeedback', data_);
//     });


//     $('#load-feedback').click(function(){
//         let issueNum = $('#feedb-load').val();
//         let data_ = {
//                 issueID: issueNum
//         }
//         request('/resident/oldHome', data_);
//     });


//     $('#submit-update-issue').click(function(event){
//         event.preventDefault();
//         let issueNum = $('#ID-number-update').val();
//         let stat = $('#current-status').val();
//         console.log(issueNum);
//         console.log(stat);
//         let data_ = {
//                 issueID: issueNum,
//                 status: stat
//         }

//         request('/issues/updateIssue', data_);
//     });


//     $('#add-user').click(function(event){

//     });
// });


// function index() {
//     $.ajax(URLROOT+"/pages/loginPage", {
//         type: "POST",
//         error: function(xhr, status, error) {
//             alert(xhr.responseText);
//             }
//     }).done(function (response) {
//         console.log(response)
//         // let resObj = JSON.parse(response);
//         const main = document.querySelector("main");

//         // main.innerHTML=resObj.message;

//     }).fail(function () {
//         alert('Something went wrong with a request to the server');
//     });
// }

// function request(url, data_={}){
//     $.ajax(URLROOT+url, {
//         type: "POST",
//         data: data_
//     }).done(function (response) {
//         let resObj = JSON.parse(response);
//         const main = document.querySelector("main");
//         console.log(resObj.loggedIn);
//         if (resObj.loggedIn === -1) {
//             $('#alertbox').html(resObj.message);
//             $('.w-form-fail').show();
//         } if (resObj.loggedIn === 1) {
//             $('#alertbox').html("Login Successful");
//             console.log();
//             main.innerHTML=resObj.message;
            
//         } if (resObj.loggedIn === 0) {
//             $('#alertbox').html(resObj.message);
//             $('.w-form-fail').show();
//         }
//     }).fail(function () {
//         alert('Something went wrong with a request to the server');
//     });
// }
