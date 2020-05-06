/**
 * Start the saving spinner
 */
function startSpinner() {
  const save = $('#save');
  save.html(`
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  `);
}

/**
 * Stop the saving spinner
 */
function stopSpinner() {
  const save = $('#save');
  save.html('Save');
}

/**
 * Show the success status
 */
function showSuccess() {
  showStatus();
}
/**
 * Show the error status
 */
function showError() {
  showStatus('error');
}

/**
 * Show either the success or error status
 */
function showStatus(status='success') {
  const success = document.getElementById('save-success');
  const fail = document.getElementById('save-fail');

  if (status === 'success')
    success.style.bottom = '-5px';
  else
    fail.style.bottom = '-5px';

  setTimeout(() => {
    success.style.bottom = '-70px';
    fail.style.bottom = '-70px';
  }, 5000);
}
