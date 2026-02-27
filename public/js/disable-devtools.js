// Disable right-click
document.addEventListener('contextmenu', e => e.preventDefault());

// Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
document.onkeydown = function(e) {
  if(e.keyCode == 123 || // F12
     (e.ctrlKey && e.shiftKey && e.keyCode == 73) || // Ctrl+Shift+I
     (e.ctrlKey && e.shiftKey && e.keyCode == 74) || // Ctrl+Shift+J
     (e.ctrlKey && e.keyCode == 85)) { // Ctrl+U
    return false;
  }
};

// Disable text selection
document.onselectstart = function() {
  return false;
};

// Disable copy
document.oncopy = function() {
  return false;
};
