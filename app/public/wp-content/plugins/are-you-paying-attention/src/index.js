import "./index.scss";
import { TextControl, Flex, FlexBlock, FlexItem, Button, Icon, PanelBody, PanelRow, ColorPicker } from "@wordpress/components";
import { InspectorControls } from "@wordpress/block-editor";
import { ChromePicker } from "react-color";

// IIFE so we have scoped variables
// TODO: Show info to user about why the post can't be updated when it's locked
(function () {
    let locked = false;

    wp.data.subscribe(function () {
        const results = wp.data.select("core/block-editor").getBlocks().filter(block => {
            return block.name == "ourplugin/are-you-paying-attention" && block.attributes.correctAnswer === undefined;
        });
        if (results.length > 0 && !locked) {
            locked = true;
            wp.data.dispatch("core/editor").lockPostSaving("noanswer");
        }

        if (results.length == 0 && locked) {
            locked = false;
            wp.data.dispatch("core/editor").unlockPostSaving("noanswer");
        }
    })
})();

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        question: { type: "string" },
        answers: { type: "array", default: [""] },
        correctAnswer: { type: "number", default: undefined },
        bgColor: { type: "string", default: "#EBEBEB" }
    },
    edit: EditComponent,
    save: function (props) {
        return null;
    },
});

function EditComponent(props) {
    const updateQuestion = (value) => {
        props.setAttributes({ question: value });
    }

    const deleteAnswer = (indexToDelete) => {
        const newAnswers = props.attributes.answers.filter((_, index) => index !== indexToDelete);

        if (indexToDelete == props.attributes.correctAnswer) {
            props.setAttributes({ correctAnswer: undefined });
        }

        props.setAttributes({ answers: newAnswers });
    }

    const markAsCorrect = (index) => {
        props.setAttributes({ correctAnswer: index });
    }

    return (
        <div className="paying-attention-edit-block" style={{ backgroundColor: props.attributes.bgColor }}>
            <InspectorControls>
                <PanelBody title="Background Color" initialOpen={true}>
                    <ChromePicker color={props.attributes.bgColor} onChangeComplete={({ hex }) => props.setAttributes({ bgColor: hex })} disableAlpha={true} />
                </PanelBody>
            </InspectorControls>
            <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{ fontSize: '20px' }} />
            <p style={{ fontSize: '13px', margin: '20px 0 8px' }}>Answers:</p>
            {props.attributes.answers.map((answer, index) => (
                <Flex>
                    <FlexBlock>
                        <TextControl
                            autoFocus={answer == undefined}
                            value={answer} onChange={newValue => {
                                const newAnswers = props.attributes.answers.concat([]);
                                newAnswers[index] = newValue;
                                props.setAttributes({ answers: newAnswers });
                            }}></TextControl>
                    </FlexBlock>
                    <FlexItem>
                        <Button onClick={() => markAsCorrect(index)}>
                            <Icon className="mark-as-correct" icon={props.attributes.correctAnswer == index ? "star-filled" : "star-empty"} />
                        </Button>
                    </FlexItem>
                    <FlexItem>
                        <Button isLink className="attention-delete" onClick={() => deleteAnswer(index)}>Delete</Button>
                    </FlexItem>
                </Flex>
            ))}
            <Button isPrimary onClick={() => {
                const newAnswers = props.attributes.answers.concat([undefined]);
                props.setAttributes({ answers: newAnswers });
            }}>Add another answer</Button>
        </div>
    )
}