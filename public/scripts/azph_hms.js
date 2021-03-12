const URLROOT;
$(document).ready(function () {
    URLROOT='http://localhost/COMP2171/HMS'

    $('.submit-button').click
    (function (event) {
        event.preventDefault();
        let id_ = $('#name').val();
        let password = $('#email').val();
        //console.log('hello');
        $.ajax(URLROOT+"/users/login", {
            type: "POST",
            data: {
                id: id_,
                password: password_
            }
        }).done(function (response) {
            let resObj = JSON.parse(response);
            const main = document.querySelector("main");
            console.log(resObj.loggedIn);
            if (resObj.loggedIn === -1) {
                $('#alertbox').html(resObj.message);
                $('.w-form-fail').show();
            } if (resObj.loggedIn === 1) {
                $('#alertbox').html("Login Successful");
                console.log();
                main.innerHTML=resObj.message;
                //window.location.replace(resObj.message);
            } if (resObj.loggedIn === 0) {
                $('#alertbox').html(resObj.message);
                $('.w-form-fail').show();
            }
        }).fail(function () {
            alert('Something went wrong with a request to the server');
        });
    });


    $('#continue-button').click(function () {
        
        window.location.replace("old-home.php");
    });

    $('.sign-out').click(function () {
        window.location.replace("index.php");
    });

    $('#log-issue').click(function () {
        window.location.replace("log-issue.php");
    });

    $('#track-issue').click(function () {
        window.location.replace("track-issue.php");
    });

    $('#track-issue-1').click(function (event) {
        event.preventDefault();
        let idnum = $('#track-idNum').val();
        //console.log(idnum);
        $.ajax("backend/show-issues.php", {
            type: "POST",
            data: {
                IDnum: idnum
            }
        }).done(function (response) {
            //alert(response);
            $('#show-issues-1').html(response);
        }).fail(function () {
            alert('Something went wrong with the server');
        });
    });

    /*$('.w-nav-menu').click(function(){
        $('.w-nav-menu').show();
    });*/

    $('#submit-issue').click(function (event) {
        event.preventDefault();
        let clust = $('#cluster').val();
        let cat = $('#classification').val();
        let desc = $('#Issue-description').val();
        let idN = $('#IDapp').val();
        /*console.log(clust);
        console.log(cat);*/
        //console.log(desc);
        //console.log(idN);
        $.ajax("backend/res-sub-issue.php", {
            type: "POST",
            data: {
                residentID: idN,
                cluster: clust,
                classification: cat,
                description: desc
            }
        }).done(function (response) {
            console.log(response);
            if (response === "FAILED") {
                $('.w-form-fail').show();
            } else {
                $('.w-form-done').show();
                //window.location.replace("../old-home.php");
                window.location.replace("old-home.php");
            }
        }).fail(function () {
            alert('Something went wrong with a request to the server');
            $('.w-form-fail').show();
        });
    });



    /*$('#add-feedback-track-0').click(function (event) {
        event.preventDefault();
        console.log('testing feedback');
    });
    var tracks = document.getElementsByClassName("add-feedback-track");
    for (var i = 0; i < tracks.length; i++) {
        tracks.item[i].click(function (event) {
            event.preventDefault();
            console.log('here');

        })
    }*/

    $('#give-feedback').click(function(event) {
        event.preventDefault(); 
        let Iid = $('#isseue-id').val();
        let Id = $('#ID-number').val();
        let desc = $('#Issue-description').val();
        $.ajax("give-feedback.php", {
            type: "POST",
            data: {
                issueID: Iid,
                ID: Id,
                description: desc
            }
        }).done(function (response) {
            console.log(response);
            if (response === "FAILED") {
                $('.w-form-fail').show();
            } else {
                $('.w-form-done').show();
                alert('Feedback added!')
                window.location.replace("old-home.php");
            }
        }).fail(function () {
            alert('Something went wrong with a request to the server');
            $('.w-form-fail').show();
        });
    });

    $('#load-feedback').click(function(){
        let issueNum = $('#feedb-load').val();
        $.ajax("old-home.php",{
            type: "POST",
            data: {
                issueID: issueNum
            }
        }).done(function(response){
            //console.log(response);
            //alert("Feedback Loaded!");
            $('body').html(response);
        }).fail(function(){
            alert('Something went wrong with a request to the server');
        });
    });

    $('#submit-update-issue').click(function(event){
        event.preventDefault();
        let issueNum = $('#ID-number-update').val();
        let stat = $('#current-status').val();
        console.log(issueNum);
        console.log(stat);
        $.ajax("update-issue.php", {
            type: "POST",
            data: {
                issueID: issueNum,
                status: stat
            }
        }).done(function(){
            $('.w-form-done').show();
            alert('Feedback added!')
        }).fail(function(){
            alert('Something went wrong with the server');
            $('.w-form-fail').show();
        });
    });


    $('#add-user').click(function(event){

    });
});