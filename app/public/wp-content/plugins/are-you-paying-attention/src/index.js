import "./index.scss";
import { TextControl, Flex, FlexBlock, FlexItem, Button, Icon } from "@wordpress/components";

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        skyColor: { type: "string" },
        grassColor: { type: "string" }
    },
    edit: EditComponent,
    save: function (props) {
        return null;
    },
});

function EditComponent(props) {
    const updateSkyColor = (event) => {
        props.setAttributes({ skyColor: event.target.value });
    }
    const updateGrassColor = (event) => {
        props.setAttributes({ grassColor: event.target.value });
    }
    return (
        <div className="paying-attention-edit-block">
            {/* <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor} />
            <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor} /> */}
            <TextControl label="Question:" />
            <p>Answers:</p>
            <Flex>
                <FlexBlock>
                    <TextControl></TextControl>
                </FlexBlock>
                <FlexItem>
                    <Button>
                        <Icon icon="star-empty" />
                    </Button>
                </FlexItem>
                <FlexItem>
                    <Button>Delete</Button>
                </FlexItem>
            </Flex>

        </div>
    )
}