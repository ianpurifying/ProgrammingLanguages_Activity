document.addEventListener("DOMContentLoaded", function () {
  const notificationBtn = document.getElementById("notificationBtn");
  const notificationDropdown = document.getElementById("notificationDropdown");
  const notificationList = document.getElementById("notificationList");
  const notificationCount = document.getElementById("notificationCount");

  if (notificationBtn) {
    notificationBtn.addEventListener("click", function () {
      notificationDropdown.classList.toggle("hidden");
      loadNotifications();
    });
  }

  function loadNotifications() {
    fetch("api/notifications.php")
      .then((response) => response.json())
      .then((data) => {
        notificationList.innerHTML = "";
        if (data.length > 0) {
          notificationCount.textContent = data.length;
          notificationCount.classList.remove("hidden");
          data.forEach((notification) => {
            const item = document.createElement("div");
            item.className = "notification-item";
            item.innerHTML = `
                            <div class="text-sm font-medium">${notification.title}</div>
                            <div class="text-xs text-gray-500">${notification.time}</div>
                        `;
            notificationList.appendChild(item);
          });
        } else {
          notificationCount.classList.add("hidden");
          notificationList.innerHTML =
            '<div class="notification-item text-gray-500">No new notifications</div>';
        }
      });
  }

  function loadActivities() {
    fetch("api/activities.php")
      .then((response) => response.json())
      .then((data) => {
        const container = document.getElementById("recentActivities");
        if (container) {
          container.innerHTML = "";
          data.forEach((activity) => {
            const item = document.createElement("div");
            item.className = "activity-item";
            item.innerHTML = `
                            <div class="flex-shrink-0">
                                <i class="fas ${activity.icon} text-blue-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">${activity.description}</p>
                                <p class="text-xs text-gray-500">${activity.time}</p>
                            </div>
                        `;
            container.appendChild(item);
          });
        }
      });
  }

  loadNotifications();
  loadActivities();
  setInterval(loadNotifications, 30000);
  setInterval(loadActivities, 30000);

  document.addEventListener("click", function (e) {
    if (
      !notificationBtn.contains(e.target) &&
      !notificationDropdown.contains(e.target)
    ) {
      notificationDropdown.classList.add("hidden");
    }
  });
});

function confirmDelete(id, type) {
  if (confirm("Are you sure you want to delete this record?")) {
    window.location.href = `delete.php?id=${id}`;
  }
}

function toggleSort(field) {
  const url = new URL(window.location.href);
  const currentSort = url.searchParams.get("sort");
  const currentOrder = url.searchParams.get("order");

  if (currentSort === field && currentOrder === "ASC") {
    url.searchParams.set("order", "DESC");
  } else {
    url.searchParams.set("order", "ASC");
  }
  url.searchParams.set("sort", field);
  window.location.href = url.toString();
}
