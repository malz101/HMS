window.onload = () => {
    const URLROOT='http://localhost/COMP2171/HMS';
    const assign_maintenance_btn = document.getElementById("assign-maintenance-btn");
    const assignbtns = document.querySelectorAll(".assign-btn");
    const closebtn = document.getElementById("close-btn");

    closebtn.onclick = ()=>{
        document.getElementById("assign-popup").style.display = "none";
    }

    assign_maintenance_btn.onclick = ()=>{
        document.getElementById("assign-popup").style.display = "block";
    }

    for (let i=0; i<assignbtns.length; i++){
        assignbtns[i].onclick = function () {
            let mtnid = this.id;
            
            let issueid = document.querySelector(".issue").id;
            window.location.replace(URLROOT+'/admin/assignPersonnel/'+issueid+'/'+mtnid);
            // fetch('/admin/assignPersonnel',{
            //     method: 'post',
            //     body: JSON.stringify({iid: issueid, mid: mtnid})
            // })
            // .then(response => response.json())
            // .then(data => {
            //     console.log(data)
            // });
            // document.getElementById("assign-popup").style.display = "none";
        }

        
    }

};