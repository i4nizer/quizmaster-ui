

//# Manage Drawer
$(() => {

    // Drawer State
    let drawer = true
    
    // Toggle Drawer
    $('.drawer-toggle').click(() => {
        
        // Hide Links First
        $('.drawer-link').css('display', 'none')
        
        // Toggle
        $('.drawer').fadeToggle(250, () => {
            $('.drawer').css('width', drawer ? '0' : 'min(300px, 100dvw)')
            $('.drawer').css('display', drawer ? 'none' : 'flex')
            $('.drawer-link').css('display', drawer ? 'none' : 'flex')
        })
        
        // Change State
        drawer = !drawer
    })

    // Hovered Link in Drawer
    $('.drawer-link').hover((e) => $(e.target).toggleClass('bg-light'))

    
    // Active Link in Drawer
    for (dlink of $('.drawer-link')) {
        const dl = $(dlink)
        
        const currentUrl = window.location.href.replace('/index.php', '')
        const baseUrl = dl.attr('href').replace('/index.php', '')

        if (currentUrl.startsWith(baseUrl)) dl.addClass('bg-dark text-white')
        else dl.removeClass('bg-dark text-white')
    }
    

})