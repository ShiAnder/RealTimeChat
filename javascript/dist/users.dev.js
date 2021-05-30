"use strict";

var searchBar = document.querySelector(".users .search input"),
    searchBtn = document.querySelector(".users .search button");

searchBtn.onclick = function () {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
};