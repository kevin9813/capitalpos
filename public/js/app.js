// --- Sidebar ---
const sidebar = document.getElementById('sidebar');
const openBtn = document.getElementById('openSidebar');
const closeBtn = document.getElementById('closeSidebar');

openBtn.addEventListener('click', () => sidebar.classList.remove('-translate-x-full'));
closeBtn.addEventListener('click', () => sidebar.classList.add('-translate-x-full'));

// --- Tema claro/oscuro ---
const themeToggle = document.getElementById('themeToggle');
const html = document.documentElement;

// Cargar tema inicial
if (localStorage.theme === 'dark' || 
    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {

    html.classList.add('dark');
    themeToggle.innerHTML = '<i class="fa-solid fa-moon"></i>';
} else {
    html.classList.remove('dark');
    themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
}

// Cambiar tema al dar clic
themeToggle.addEventListener('click', () => {
    html.classList.toggle('dark');

    if (html.classList.contains('dark')) {
        localStorage.theme = 'dark';
        themeToggle.innerHTML = '<i class="fa-solid fa-moon"></i>';
    } else {
        localStorage.theme = 'light';
        themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
    }
});

document.addEventListener('livewire:init', () => {
    
    Livewire.on('toast', data => {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#fff',
            color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
        })
    });

    Livewire.on('alert', data => {
        Swal.fire({
            title: data.title,
            text: data.text,
            icon: data.icon,
            timer: 2500,
            showConfirmButton: false,
            background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#fff',
            color: document.documentElement.classList.contains('dark') ? '#fff' : '#000'
        })
    });

});