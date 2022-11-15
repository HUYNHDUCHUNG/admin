window.onload = function () {
  let spanlist = document.querySelectorAll(".footer .column > span");
  spanlist.forEach(function (item) {
    item.style.height = Math.floor(Math.random() * 100 + 1) + "%";
  });
};
// <i class='bx bxs-chevron-up'></i>
let downList = document.querySelectorAll(".arrow");
let subMenu = document.querySelectorAll(".sub-menu");
downList.forEach(function (item, index) {
  item.addEventListener("click", function () {
    subMenu[index].classList.toggle("active");
    item.classList.toggle("bxs-chevron-up");
  });
});
