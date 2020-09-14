import React from 'react'

function PasswordReset() {
    const cardStyle = {
        borderRadius: '25px',
    }

    const leftColStyle = {
        borderTopLeftRadius: '25px',
        borderBottomLeftRadius: '25px',
        borderTopRightRadius: '0px',
        borderBottomRightRadius: '0px',
    }

    const rightColStyle = {
        borderTopLeftRadius: '0px',
        borderBottomLeftRadius: '0px',
        borderTopRightRadius: '25px',
        borderBottomRightRadius: '25px',
    }

    return (
        <div>
            <div className="card py-0" style={ cardStyle }>
                <div className="card-body pb-1 pt-3">
                    <div className="row">
                        <div className="col-md-6 mb-2 pr-0">
                            <input type="password" className="form-control" placeholder="Current Password" style={ leftColStyle } />
                        </div>
                        <div className="col-md-6 mb-2 pl-0">
                            <input type="password" className="form-control" placeholder="New Password" style={ rightColStyle } />
                        </div>
                        <div className="col-md-6 mb-2 pr-0">
                            <input type="password" className="form-control" placeholder="Confirm Password" style={ leftColStyle } />
                        </div>
                        <div className="col-md-6 mb-2 pl-0">
                            <button type="submit" className="btn btn-dark w-100" style={ rightColStyle }>Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default PasswordReset
