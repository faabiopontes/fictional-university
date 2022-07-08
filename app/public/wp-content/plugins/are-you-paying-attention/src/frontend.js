import React from 'react';
import ReactDOM from 'react-dom';
import "./frontend.scss";

const divsToUpdate = document.querySelectorAll('.paying-attention-update-me');
const Quiz = (props) => {
    return (
        <div className="paying-attention-frontend">
            <p>{props.question}</p>
            <ul>
                {props.answers.map(answer => <li>{answer}</li>)}
            </ul>
        </div>
    )
}
divsToUpdate.forEach((div => {
    const data = JSON.parse(div.querySelector("pre").innerHTML);
    ReactDOM.render(<Quiz {...data} />, div);
    div.classList.remove('paying-attention-update-me');
}));