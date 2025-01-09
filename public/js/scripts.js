document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.add('fade');
            alert.classList.remove('show');

            alert.addEventListener('transitionend', () => {
                alert.remove();
            });
        });
    }, 3000);
});