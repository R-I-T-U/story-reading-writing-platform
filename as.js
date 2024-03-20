// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}

// Get all delete and ignore buttons
const deleteBtns = document.querySelectorAll('.delete-btn');
const ignoreBtns = document.querySelectorAll('.ignore-btn');

// Add click event listeners to delete buttons
deleteBtns.forEach((btn, index) => {
  btn.addEventListener('click', () => {
    // Delete the corresponding comment
    const commentContainer = btn.closest('.comment-container');
    commentContainer.remove();
  });
});

// Add click event listeners to ignore buttons
ignoreBtns.forEach((btn, index) => {
  btn.addEventListener('click', () => {
    // Ignore the corresponding comment
    const commentContainer = btn.closest('.comment-container');
    commentContainer.style.display = 'none';
  });
});