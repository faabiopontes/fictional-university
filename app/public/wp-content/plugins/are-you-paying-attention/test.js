wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    edit: function () {
        // This return is what is shown on admin when page is being editted
        return wp.element.createElement("h3", null, "Hello, this is from the admin editor screen.");
    },
    save: function () { 
        // This return is what is saved on the database and shown when the post is open
        return wp.element.createElement("h3", null, "This is the frontend.");
    }
});