document.addEventListener("DOMContentLoaded", function () {
  const notificationBtn = document.getElementById("notificationBtn");
  const notificationDropdown = document.getElementById("notificationDropdown");

  if (notificationBtn) {
    notificationBtn.addEventListener("click", function () {
      notificationDropdown.classList.toggle("hidden");
      loadNotifications();
    });
  }

  // Add loading states
  showLoadingStates();

  loadNotifications();
  loadActivities();
  loadAnalytics();

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

  // Add animation observer for cards
  observeAnimations();
});

function showLoadingStates() {
  const containers = [
    "topUsersContainer",
    "avgResolutionTime",
    "peakActivityContainer",
  ];
  containers.forEach((id) => {
    const element = document.getElementById(id);
    if (element) {
      element.innerHTML = '<div class="loading-shimmer h-4 rounded"></div>';
    }
  });
}

function observeAnimations() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.animationDelay = Math.random() * 0.5 + "s";
          entry.target.classList.add("animate-fade-in");
        }
      });
    },
    { threshold: 0.1 }
  );

  document.querySelectorAll(".analytics-card").forEach((card) => {
    observer.observe(card);
  });
}

function loadActivities() {
  const container = document.getElementById("recentActivities");
  if (container) {
    container.innerHTML = '<div class="loading-shimmer h-20 rounded-xl"></div>';
  }

  fetch("api/activities.php")
    .then((response) => response.json())
    .then((data) => {
      if (container) {
        container.innerHTML = "";
        if (data.length === 0) {
          container.innerHTML = `
            <div class="text-center py-12">
              <i class="fas fa-clipboard-list text-4xl text-gray-300 mb-4"></i>
              <p class="text-gray-500">No recent activities.</p>
            </div>
          `;
          return;
        }

        data.forEach((activity, index) => {
          const item = document.createElement("div");
          item.className = "activity-item flex items-center space-x-4";
          item.style.animationDelay = `${index * 0.1}s`;
          item.innerHTML = `
            <div class="flex-shrink-0">
              <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                <i class="fas ${activity.icon} text-emerald-600"></i>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-semibold text-gray-900">${activity.description}</p>
              <p class="text-xs text-gray-500 flex items-center mt-1">
                <i class="fas fa-clock mr-1"></i>
                ${activity.time}
              </p>
            </div>
            <div class="flex-shrink-0">
              <div class="w-2 h-2 bg-emerald-400 rounded-full"></div>
            </div>
          `;
          container.appendChild(item);

          // Add entrance animation
          setTimeout(() => {
            item.style.opacity = "0";
            item.style.transform = "translateX(-20px)";
            item.style.transition = "all 0.3s ease";
            requestAnimationFrame(() => {
              item.style.opacity = "1";
              item.style.transform = "translateX(0)";
            });
          }, index * 100);
        });
      }
    })
    .catch((error) => {
      console.error("Error loading activities:", error);
      if (container) {
        container.innerHTML = `
          <div class="text-center py-12">
            <i class="fas fa-exclamation-triangle text-4xl text-red-300 mb-4"></i>
            <p class="text-red-500">Error loading activities.</p>
          </div>
        `;
      }
    });
}

function loadNotifications() {
  fetch("api/notifications.php")
    .then((response) => response.json())
    .then((data) => {
      const notificationList = document.getElementById("notificationList");
      const notificationCount = document.getElementById("notificationCount");

      if (notificationList) {
        notificationList.innerHTML = "";
        if (data.length > 0) {
          notificationCount.textContent = data.length;
          notificationCount.classList.remove("hidden");
          data.forEach((notification) => {
            const item = document.createElement("div");
            item.className =
              "notification-item px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 border-b border-gray-100";
            item.innerHTML = `
              <div class="flex items-start space-x-3">
                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                <div class="flex-1">
                  <div class="text-sm font-semibold text-gray-900">${notification.title}</div>
                  <div class="text-xs text-gray-500 mt-1 flex items-center">
                    <i class="fas fa-clock mr-1"></i>
                    ${notification.time}
                  </div>
                </div>
              </div>
            `;
            notificationList.appendChild(item);
          });
        } else {
          notificationCount.classList.add("hidden");
          notificationList.innerHTML = `
            <div class="notification-item px-4 py-8 text-center">
              <i class="fas fa-bell-slash text-2xl text-gray-300 mb-2"></i>
              <div class="text-gray-500 text-sm">No new notifications</div>
            </div>
          `;
        }
      }
    })
    .catch((error) => {
      console.error("Error loading notifications:", error);
    });
}

function loadAnalytics() {
  fetch("api/analytics.php")
    .then((response) => response.json())
    .then((data) => {
      createInquiriesChart(data.inquiries_over_time);
      createCategoryChart(data.category_breakdown);
      displayTopUsers(data.top_users);
      displayResolutionTime(data.average_resolution_time);
      displayPeakActivity(data.peak_hours, data.peak_days);
    })
    .catch((error) => {
      console.error("Error loading analytics:", error);
    });
}

function createInquiriesChart(data) {
  const ctx = document.getElementById("inquiriesChart").getContext("2d");

  const dates = data.map((item) => new Date(item.date).toLocaleDateString());
  const counts = data.map((item) => parseInt(item.count));

  new Chart(ctx, {
    type: "line",
    data: {
      labels: dates,
      datasets: [
        {
          label: "Inquiries",
          data: counts,
          borderColor: "#3B82F6",
          backgroundColor: "rgba(59, 130, 246, 0.1)",
          tension: 0.4,
          fill: true,
          pointBackgroundColor: "#3B82F6",
          pointBorderColor: "#ffffff",
          pointBorderWidth: 2,
          pointRadius: 6,
          pointHoverRadius: 8,
          pointHoverBackgroundColor: "#1E40AF",
          pointHoverBorderColor: "#ffffff",
          pointHoverBorderWidth: 3,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
        tooltip: {
          backgroundColor: "rgba(0, 0, 0, 0.8)",
          titleColor: "#ffffff",
          bodyColor: "#ffffff",
          borderColor: "#3B82F6",
          borderWidth: 1,
          cornerRadius: 8,
          displayColors: false,
          callbacks: {
            title: function (context) {
              return "Date: " + context[0].label;
            },
            label: function (context) {
              return "Inquiries: " + context.parsed.y;
            },
          },
        },
      },
      scales: {
        x: {
          grid: {
            display: false,
          },
          ticks: {
            color: "#6B7280",
            font: {
              size: 11,
            },
          },
        },
        y: {
          beginAtZero: true,
          grid: {
            color: "rgba(0, 0, 0, 0.05)",
          },
          ticks: {
            stepSize: 1,
            color: "#6B7280",
            font: {
              size: 11,
            },
          },
        },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
      elements: {
        line: {
          borderWidth: 3,
        },
      },
    },
  });
}

function createCategoryChart(data) {
  const ctx = document.getElementById("categoryChart").getContext("2d");

  const labels = data.map((item) => item.category);
  const counts = data.map((item) => parseInt(item.count));

  const colors = [
    "#3B82F6",
    "#EF4444",
    "#10B981",
    "#F59E0B",
    "#8B5CF6",
    "#EC4899",
    "#06B6D4",
    "#84CC16",
    "#F97316",
    "#6366F1",
  ];

  const gradients = colors.map((color) => {
    const gradient = ctx.createRadialGradient(0, 0, 0, 0, 0, 100);
    gradient.addColorStop(0, color);
    gradient.addColorStop(1, color + "80");
    return gradient;
  });

  new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: labels,
      datasets: [
        {
          data: counts,
          backgroundColor: colors.slice(0, labels.length),
          borderWidth: 3,
          borderColor: "#ffffff",
          hoverBorderWidth: 4,
          hoverBorderColor: "#ffffff",
          hoverBackgroundColor: colors
            .slice(0, labels.length)
            .map((color) => color + "CC"),
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: "60%",
      plugins: {
        legend: {
          position: "bottom",
          labels: {
            fontSize: 12,
            padding: 15,
            usePointStyle: true,
            pointStyle: "circle",
            font: {
              size: 11,
              weight: "500",
            },
            color: "#374151",
          },
        },
        tooltip: {
          backgroundColor: "rgba(0, 0, 0, 0.8)",
          titleColor: "#ffffff",
          bodyColor: "#ffffff",
          borderColor: "#3B82F6",
          borderWidth: 1,
          cornerRadius: 8,
          displayColors: true,
          callbacks: {
            label: function (context) {
              const total = context.dataset.data.reduce((a, b) => a + b, 0);
              const percentage = ((context.parsed / total) * 100).toFixed(1);
              return (
                context.label + ": " + context.parsed + " (" + percentage + "%)"
              );
            },
          },
        },
      },
      animation: {
        animatescale: true,
        animateRotate: true,
        duration: 1500,
        easing: "easeOutQuart",
      },
    },
  });
}

function displayTopUsers(data) {
  const container = document.getElementById("topUsersContainer");

  if (data.length === 0) {
    container.innerHTML = `
      <div class="text-center py-8">
        <i class="fas fa-users text-3xl text-gray-300 mb-3"></i>
        <p class="text-gray-500 text-sm">No user data available</p>
      </div>
    `;
    return;
  }

  const html = data
    .map(
      (user, index) => `
        <div class="flex items-center justify-between p-3 rounded-lg bg-gradient-to-r from-white to-blue-50 border border-blue-100 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                    ${index + 1}
                </div>
                <div>
                    <span class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-200">${
                      user.email
                    }</span>
                    <div class="text-xs text-gray-500">Active user</div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm font-bold text-blue-600">${
                  user.inquiry_count
                }</span>
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
            </div>
        </div>
    `
    )
    .join("");

  container.innerHTML = html;

  // Add entrance animations
  container.querySelectorAll(".flex").forEach((item, index) => {
    item.style.opacity = "0";
    item.style.transform = "translateY(10px)";
    setTimeout(() => {
      item.style.transition = "all 0.3s ease";
      item.style.opacity = "1";
      item.style.transform = "translateY(0)";
    }, index * 100);
  });
}

function displayResolutionTime(avgTime) {
  const element = document.getElementById("avgResolutionTime");
  element.style.opacity = "0";
  element.style.transform = "scale(0.8)";

  setTimeout(() => {
    element.textContent = avgTime;
    element.style.transition = "all 0.5s cubic-bezier(0.4, 0, 0.2, 1)";
    element.style.opacity = "1";
    element.style.transform = "scale(1)";

    // Add pulse effect for emphasis
    if (avgTime > 0) {
      element.classList.add("pulse-glow");
      setTimeout(() => {
        element.classList.remove("pulse-glow");
      }, 2000);
    }
  }, 300);
}

function displayPeakActivity(hours, days) {
  const container = document.getElementById("peakActivityContainer");

  let html = "";

  if (hours.length > 0) {
    const topHour = hours[0];
    const hour12 =
      topHour.hour === 0
        ? "12 AM"
        : topHour.hour < 12
        ? `${topHour.hour} AM`
        : topHour.hour === 12
        ? "12 PM"
        : `${topHour.hour - 12} PM`;
    html += `
      <div class="flex items-center justify-between p-3 rounded-lg bg-gradient-to-r from-white to-violet-50 border border-violet-100 hover:shadow-md transition-all duration-200 group">
          <div class="flex items-center space-x-2">
              <i class="fas fa-clock text-violet-600"></i>
              <span class="text-sm font-medium text-gray-700 group-hover:text-violet-700 transition-colors duration-200">Peak Hour</span>
          </div>
          <span class="text-sm font-bold text-violet-600 flex items-center">
              ${hour12}
              <div class="w-2 h-2 bg-violet-400 rounded-full ml-2 animate-pulse"></div>
          </span>
      </div>
    `;
  }

  if (days.length > 0) {
    const topDay = days[0];
    html += `
      <div class="flex items-center justify-between p-3 rounded-lg bg-gradient-to-r from-white to-violet-50 border border-violet-100 hover:shadow-md transition-all duration-200 group">
          <div class="flex items-center space-x-2">
              <i class="fas fa-calendar-day text-violet-600"></i>
              <span class="text-sm font-medium text-gray-700 group-hover:text-violet-700 transition-colors duration-200">Peak Day</span>
          </div>
          <span class="text-sm font-bold text-violet-600 flex items-center">
              ${topDay.day}
              <div class="w-2 h-2 bg-violet-400 rounded-full ml-2 animate-pulse"></div>
          </span>
      </div>
    `;
  }

  if (html === "") {
    html = `
      <div class="text-center py-8">
        <i class="fas fa-chart-bar text-3xl text-gray-300 mb-3"></i>
        <p class="text-gray-500 text-sm">No activity data available</p>
      </div>
    `;
  }

  container.innerHTML = html;

  // Add entrance animations
  container.querySelectorAll(".flex").forEach((item, index) => {
    item.style.opacity = "0";
    item.style.transform = "translateX(-10px)";
    setTimeout(() => {
      item.style.transition = "all 0.3s ease";
      item.style.opacity = "1";
      item.style.transform = "translateX(0)";
    }, index * 150);
  });
}
