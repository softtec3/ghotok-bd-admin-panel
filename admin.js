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

// Modal
const modal = document.getElementById("modal");
const closeModal = document.getElementById("closeModal");
const viewBtns = document.querySelectorAll(".view-btn");
const modalName = document.getElementById("modalName");

viewBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    modalName.textContent = btn.dataset.name;
    modal.style.display = "flex";
  });
});
closeModal.addEventListener("click", () => (modal.style.display = "none"));
window.addEventListener("click", (e) => {
  if (e.target === modal) modal.style.display = "none";
});
