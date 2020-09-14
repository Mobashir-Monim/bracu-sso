import React from 'react'

const ProfileInfo = ({ name, email, status, toggler }) => {
    const cardStyle = {
        borderRadius: '25px',
    }

    const statusStyle = {
        // fontSize: '0.9em',
        color: status == 'Active' ? '#38c172' : '#e3342f'
    }

    return (
        <div>
            <div className="card" style={ cardStyle }>
                <div className="card-body pb-2">
                    <h5>{ name }</h5>
                    <p className="mb-1">{ email }</p>
                    <div className="custom-control custom-switch text-right">
                        <input type="checkbox" className="custom-control-input" id="customSwitch1" value="test" defaultChecked={ status == 'Active' ? true : false } onClick={ toggler } />
                        <label className="custom-control-label" htmlFor="customSwitch1" style={ statusStyle }><i>{ status }</i></label>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default ProfileInfo
