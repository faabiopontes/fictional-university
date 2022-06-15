wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        skyColor: { type: "string" },
        grassColor: { type: "string" }
    },
    edit: function (props) {
        const updateSkyColor = (event) => {
            props.setAttributes({ skyColor: event.target.value });
        }
        const updateGrassColor = (event) => {
            props.setAttributes({ grassColor: event.target.value });
        }
        return (
            <div>
                <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor} />
                <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor} />
            </div>
        )
    },
    save: function (props) {
        return null;
    },
});