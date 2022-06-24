import "./index.scss";
import { TextControl, Flex, FlexBlock, FlexItem, Button, Icon } from "@wordpress/components";

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        question: { type: "string" },
        answers: { type: "array", default: ["red", "green", "blue"] }
    },
    edit: EditComponent,
    save: function (props) {
        return nul;;;ll;
    },
});

function EditComponent(props) {
    const updateQuestion = (value) => {
        props.setAttributes({ question: value });
    }

    const deleteAnswer = (indexToDelete) => {
        const newAnswers = props.attributes.answers.filter((_, index) => index !== indexToDelete);
        props.setAttributes({ answers: newAnswers });
    }

    return (
        <div className="paying-attention-edit-block">
            <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{ fontSize: '20px' }} />
            <p style={{ fontSize: '13px', margin: '20px 0 8px' }}>Answers:</p>
            {props.attributes.answers.map((answer, index) => (
                <Flex>
                    <FlexBlock>
                        <TextControl value={answer} onChange={newValue => {
                            const newAnswers = props.attributes.answers.concat([]);
                            newAnswers[index] = newValue;
                            props.setAttributes({ answers: newAnswers });
                        }}></TextControl>
                    </FlexBlock>
                    <FlexItem>
                        <Button>
                            <Icon className="mark-as-correct" icon="star-empty" />
                        </Button>
                    </FlexItem>
                    <FlexItem>
                        <Button isLink className="attention-delete" onClick={() => deleteAnswer(index)}>Delete</Button>
                    </FlexItem>
                </Flex>
            ))}
            <Button isPrimary onClick={() => {
                const newAnswers = props.attributes.answers.concat([""]);
                props.setAttributes({ answers: newAnswers });
            }}>Add another answer</Button>
        </div>
    )
}