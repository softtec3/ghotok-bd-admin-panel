// Sidebar drawer
const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");
const closeSidebar = document.getElementById("closeSidebar");

menuBtn.addEventListener("click", () => {
  sidebar.classList.add("open");
});
closeSidebar.addEventListener("click", () => {
  sidebar.classList.remove("open");
});

// Navigation section toggle
const links = document.querySelectorAll(".nav-link");
const sections = document.querySelectorAll(".content-section");

links.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    links.forEach((l) => l.classList.remove("active"));
    link.classList.add("active");

    const target = link.dataset.target;
    sections.forEach((sec) => {
      sec.classList.toggle("active", sec.id === target);
    });

    sidebar.classList.remove("open");
  });
});

// image
const mainImageProfile = document.getElementById("mainImageProfile");
function handleProfileImg(target) {
  const src = target.src;
  mainImageProfile.src = src;
}
