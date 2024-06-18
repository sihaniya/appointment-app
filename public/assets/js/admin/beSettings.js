// Sidebar Toggle
var beHeaderBtn = document.getElementById("beHeaderBtn");
// var beSidebarNavClose = document.getElementById("beSidebarNavClose");
var beSidebar = document.getElementById("beSidebar");
// beHeaderBtn.addEventListener("click", function () {
//     beSidebar.classList.contains("on")
//         ? beSidebar.classList.remove("on")
//         : beSidebar.classList.add("on");
//     beBackdrop.classList.remove("d-none");
// });
// beSidebarNavClose.addEventListener("click", function () {
//     beSidebar.classList.contains("on")
//         ? beSidebar.classList.remove("on")
//         : beSidebar.classList.add("on");
//     beBackdrop.classList.add("d-none");
// });

beHeaderBtn.addEventListener("click", function () {
    beSidebar.classList.contains("on")
        ? beSidebar.classList.remove("on")
        : beSidebar.classList.add("on");
    // beBackdrop.classList.remove("d-none");
});
