wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    edit: function () {
        // This return is what is shown on admin when page is being editted
        return (
            <div>
                <p>Hello, this is a paragraph.</p>
            </div>
        )
        //wp.element.createElement("h3", null, "Hello, this is from the admin editor screen.");
    },
    save: function () { 
        // This return is what is saved on the database and shown when the post is open
        return (
            <>
                <h3>H3 on the frontend.</h3>
                <h5>H5 on the frontend.</h5>
            </>
        )
    }
});