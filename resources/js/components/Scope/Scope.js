import React from 'react'

function Scope({ name, description, info, hItem = false }) {
    return (
        <div className={`row ${ hItem ? "" : "border-bottom py-3 scope-row" }`}>
            <div className="col-md-3">{ name }</div>
            <div className="col-md">{ description }</div>
            <div className="col-md">{ info }</div>
        </div>
    )
}

export default Scope
