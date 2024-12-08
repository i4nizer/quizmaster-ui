const activateLink = (link = "Quizzes") => {
    const sidenav = $('#sidenav');
    sidenav.find('a').css({ 'color': '#a8a8a8' });
    sidenav.find(`a.${link}`).css({ 'background-color': '#313131', 'color': '#00C853' });
}

export { activateLink }