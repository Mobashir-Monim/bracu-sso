import React from 'react'

function GroupCard({ name, image }) {
    let imgContStyle = {
        height: '130px',
        backgroundImage: `url("${ image == null ? '/img/rg-placeholder.png' : image }")`,
        backgroundColor: '#cccccc',
        backgroundPosition: 'center',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover'
    }

    return (
        <div className="card hoverable-card m-3">
            <div style={ imgContStyle } className="card-img-top">
            </div>
            <div className="card-body">
                <h5>{ name }</h5>
            </div>
        </div>
    )
}

export default GroupCard
