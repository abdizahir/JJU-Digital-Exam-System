document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidenav');
    const button = document.getElementById('sidenav-btn');
    const elements = document.querySelectorAll('.sidenav-txt');
    const main = document.getElementById('main');

    // Media query
    const mediaQuery = window.matchMedia('(min-width: 992px)');

    // Media query change
    function handleMediaQuery(e) {
        if (e.matches) {
            // At least 992px
            sidebar.classList.add('side-nav-big');
            sidebar.classList.remove('side-nav-small');
            button.classList.remove('glyphicon-chevron-right');
            button.classList.add('glyphicon-chevron-left');
            elements.forEach(function(element) {
                element.classList.remove('side-nav-text');
            });
            main.classList.add('move-right');
        } else {
            // Less than 992px
            sidebar.classList.remove('side-nav-big');
            sidebar.classList.add('side-nav-small');
            button.classList.remove('glyphicon-chevron-left');
            button.classList.add('glyphicon-chevron-right');
            elements.forEach(function(element) {
                element.classList.add('side-nav-text');
            });
            main.classList.remove('move-right');
        }
    }

    handleMediaQuery(mediaQuery);

    // Listen for changes in screen size
    mediaQuery.addListener(handleMediaQuery);

    button.addEventListener('click', function() {
        sidebar.classList.toggle('side-nav-small');
        sidebar.classList.toggle('side-nav-big');
        button.classList.toggle('glyphicon-chevron-right');
        button.classList.toggle('glyphicon-chevron-left');
        elements.forEach(function(element) {
            element.classList.toggle('side-nav-text');
        });
        main.classList.toggle('move-right');
    });


    // search and filter view users table
    const searchInput = document.getElementById('userSearch');
        const filter = document.getElementById('userFilter');
        const rows = document.querySelectorAll('#usersTable tbody tr');

        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();
            const selected = filter.value.toLowerCase();

            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const department = row.children[4].textContent.toLowerCase();

                const matchesSearch = name.includes(searchValue);
                const matchesDepartment = selected === '' || department === selected;

                row.style.display = (matchesSearch && matchesDepartment) ? '' : 'none';
            });
        }

        searchInput.addEventListener('keyup', filterTable);
        filter.addEventListener('change', filterTable);
});


// Delete user
let selectedUserId = null;

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
        selectedUserId = null;
    }

    function openModal(userId) {
        selectedUserId = userId;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.user-delete').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                openModal(userId);
            });
        });
    });


    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (!selectedUserId) return;
        fetch('update.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + encodeURIComponent(selectedUserId)
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                const row = document.querySelector('tr[data-id="' + selectedUserId + '"]');
                if (row) row.remove();
                closeModal();
            } else {
                alert('Failed to delete user.');
                closeModal();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    });


    