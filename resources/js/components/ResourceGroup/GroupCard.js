import React from 'react'

function GroupCard({ name, image }) {
    let cardStyle = {
        height: '250px',
        width: '250px',
        display: 'inline-block'
    }

    let imgContStyle = {
        height: '130px',
        backgroundImage: `url("${ image }")`,
        backgroundColor: '#cccccc',
        backgroundPosition: 'center',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover'
    }

    return (
        <div className="card hoverable-card m-3" style={ cardStyle }>
            <div style={ imgContStyle } className="card-img-top">
            </div>
            <div className="card-body">
                <h5>{ name }</h5>
            </div>
        </div>
    )
}

export default GroupCard
