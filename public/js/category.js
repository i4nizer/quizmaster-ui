$(async () => {

    // Let's create a function for adding category items
    const addCategoryItem = (name) => {
        
        // Craft the category item
        const catItem = `<div class="category-item border rounded p-2">${name}</div>`

        // Reference the category list via ID and add the category item
        $('#category-list').append(catItem)
    }

    // RETRIEVE all categories
    await fetch('/user/category')
        .then(res => res.json())        // Convert the response into json
        .then(data => data.forEach(c => addCategoryItem(c.name)))   // Now the converted json is actually an array of categories so we use forEach loop
        .catch(err => console.log(err))

})