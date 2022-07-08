import React from 'react';
import ReactDOM from 'react-dom';
import "./frontend.scss";

debugger;
const divsToUpdate = document.querySelectorAll('.paying-attention-update-me');
const Quiz = () => {
    return (
        <div className="paying-attention-update-me">
            Hello from React
        </div>
    )
}
console.log({ divsToUpdate });
divsToUpdate.forEach((div => {
    ReactDOM.render(<Quiz />, div);
    div.classList.remove('paying-attention-update-me');
}));