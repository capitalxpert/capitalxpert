const episodesContainer = document.getElementById('episodes-container');
const videoPlayer = document.getElementById('video-player');

// Lista de episódios com links corrigidos para o formato embed
const episodes = [
    { id: 1, title: 'Episódio 1', url: 'https://www.youtube.com/embed/BdVlty5wQ5Y?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 2, title: 'Episódio 2', url: 'https://www.youtube.com/embed/G3aHNaR-BeM?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 3, title: 'Episódio 3', url: 'https://www.youtube.com/embed/8xWPEdW6-vo?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 4, title: 'Episódio 4', url: 'https://www.youtube.com/embed/elBjWsdZSDo?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 5, title: 'Episódio 5', url: 'https://www.youtube.com/embed/ZajUwcv05R0?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 6, title: 'Episódio 6', url: 'https://www.youtube.com/embed/Gn_wgRTG-b0?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 7, title: 'Episódio 7', url: 'https://www.youtube.com/embed/1fHQilQjj9E?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 8, title: 'Episódio 8', url: 'https://www.youtube.com/embed/QwSK8IH_Azc?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 9, title: 'Episódio 9', url: 'https://www.youtube.com/embed/98bR4gmTkc8?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 10, title: 'Episódio 10', url: 'https://www.youtube.com/embed/6djsLAU-TT0?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 11, title: 'Episódio 11', url: 'https://www.youtube.com/embed/ktS9vYq4x4E?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 12, title: 'Episódio 12', url: 'https://www.youtube.com/embed/CYem7f4y-3M?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 13, title: 'Episódio 13', url: 'https://www.youtube.com/embed/jvul47FNGdw?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 14, title: 'Episódio 14', url: 'https://www.youtube.com/embed/QJXAQ13a7eU?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 15, title: 'Episódio 15', url: 'https://www.youtube.com/embed/JaiLnwvlWpA?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 16, title: 'Episódio 16', url: 'https://www.youtube.com/embed/zg2gYAijm-g?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 17, title: 'Episódio 17', url: 'https://www.youtube.com/embed/NY2WSQXWh2w?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' },
    { id: 18, title: 'Episódio 18', url: 'https://www.youtube.com/embed/UFkC0n4CSgk?modestbranding=1&controls=1&rel=0&disablekb=1&fs=0&playsinline=1' }
];

// Função para atualizar o vídeo ao clicar
function renderEpisodes() {
    episodes.forEach(episode => {
        const episodeElement = document.createElement('div');
        episodeElement.classList.add('episode');
        episodeElement.textContent = episode.title;
        episodeElement.addEventListener('click', () => {
            videoPlayer.src = episode.url;
        });
        episodesContainer.appendChild(episodeElement);
    });

    // Define o primeiro episódio como padrão
    videoPlayer.src = episodes[0].url;
}

// Inicializa os episódios na página
renderEpisodes();
