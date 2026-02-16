// ==================== FAQ SIDEBAR TOGGLE ====================
const faqSidebar = document.getElementById('faqSidebar');
const faqTab = document.getElementById('faqTab');

if (faqTab) {
  faqTab.addEventListener('click', (e) => {
    e.stopPropagation();
    faqSidebar.classList.toggle('active');
  });
}

// Close FAQ when clicking outside
document.addEventListener('click', (e) => {
  if (faqSidebar && !faqSidebar.contains(e.target)) {
    faqSidebar.classList.remove('active');
  }
});

// ==================== CALENDAR FUNCTIONALITY ====================
const calendarDropdown = document.getElementById('calendarDropdown');
const dateToggle = document.getElementById('dateToggle');
const dateInputGroup = document.querySelector('.date-input-group');
const calendarGrid = document.getElementById('calendarGrid');
const monthYear = document.getElementById('monthYear');
const dateInput = document.getElementById('dateInput');
const prevMonthBtn = document.getElementById('prevMonth');
const nextMonthBtn = document.getElementById('nextMonth');

const MIN_DATE = new Date(2026, 0, 1); // Jan 1, 2026
const MAX_DATE = new Date(2030, 0, 31); // Jan 31, 2030

let currentDate = new Date(2026, 0, 1);
let selectedDate = null;

const monthNames = [
  'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
  'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
];

// Toggle calendar
if (dateToggle && dateInputGroup) {
  dateInputGroup.addEventListener('click', (e) => {
    e.stopPropagation();
    calendarDropdown.classList.toggle('open');
  });
}

// Close calendar when clicking outside
document.addEventListener('click', (e) => {
  if (calendarDropdown && !calendarDropdown.contains(e.target) && !dateInputGroup.contains(e.target)) {
    calendarDropdown.classList.remove('open');
  }
});

// Render calendar
function renderCalendar() {
  if (!calendarGrid || !monthYear) return;
  
  calendarGrid.innerHTML = '';
  
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();
  
  monthYear.textContent = `${monthNames[month]} ${year}`;
  
  // Get first day of month (1 = Monday, 7 = Sunday)
  const firstDay = new Date(year, month, 1).getDay() || 7;
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  
  // Add empty cells for days before month starts
  for (let i = 1; i < firstDay; i++) {
    const emptyCell = document.createElement('div');
    calendarGrid.appendChild(emptyCell);
  }
  
  // Add day cells
  for (let day = 1; day <= daysInMonth; day++) {
    const cellDate = new Date(year, month, day);
    const dayCell = document.createElement('div');
    dayCell.className = 'calendar-day';
    dayCell.textContent = day;
    
    // Check if date is available
    if (cellDate >= MIN_DATE && cellDate <= MAX_DATE) {
      dayCell.classList.add('available');
      
      // Check if this is the selected date
      if (selectedDate && 
          cellDate.getDate() === selectedDate.getDate() &&
          cellDate.getMonth() === selectedDate.getMonth() &&
          cellDate.getFullYear() === selectedDate.getFullYear()) {
        dayCell.classList.add('selected');
      }
      
      dayCell.addEventListener('click', (e) => {
        e.stopPropagation();
        
        // Remove previous selection
        document.querySelectorAll('.calendar-day').forEach(cell => {
          cell.classList.remove('selected');
        });
        
        // Add selection to clicked day
        dayCell.classList.add('selected');
        selectedDate = cellDate;
        
        // Update input
        dateInput.value = `${monthNames[month]} ${day}, ${year}`;
        
        // Close calendar
        calendarDropdown.classList.remove('open');
      });
    }
    
    calendarGrid.appendChild(dayCell);
  }
}

// Previous month
if (prevMonthBtn) {
  prevMonthBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const prevMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
    if (prevMonth >= MIN_DATE) {
      currentDate = prevMonth;
      renderCalendar();
    }
  });
}

// Next month
if (nextMonthBtn) {
  nextMonthBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const nextMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
    if (nextMonth <= MAX_DATE) {
      currentDate = nextMonth;
      renderCalendar();
    }
  });
}

// Initial render
renderCalendar();

// ==================== MARQUEE ANIMATION ====================
function setupMarquee() {
  const marqueeTrack = document.getElementById('marqueeTrack');
  if (!marqueeTrack) return;
  
  const marqueeContent = marqueeTrack.querySelector('.marquee-content');
  if (!marqueeContent) return;
  
  // Clone content multiple times for seamless loop
  for (let i = 0; i < 5; i++) {
    const clone = marqueeContent.cloneNode(true);
    marqueeTrack.appendChild(clone);
  }
}

// Initialize on load
window.addEventListener('load', setupMarquee);

// ==================== FORM SUBMISSION ====================
// Remove form validation - let HTML5 and Laravel handle it
// The form will submit normally to the server

// ==================== SMOOTH SCROLL ====================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href === '#') return;
    
    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

// ==================== HEADER SCROLL EFFECT ====================
let lastScroll = 0;
const header = document.querySelector('.main-header');

window.addEventListener('scroll', () => {
  const currentScroll = window.pageYOffset;
  
  if (currentScroll > 100) {
    header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
  } else {
    header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
  }
  
  lastScroll = currentScroll;
});


    // IntersectionObserver for statement-section visibility
  document.addEventListener("DOMContentLoaded", function () {
    const section = document.querySelector(".statement-section");
    if (!section) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
          } else {
            entry.target.classList.remove("is-visible");
          }
        });
      },
      { threshold: 0.1 }
    );

    observer.observe(section);
  });
