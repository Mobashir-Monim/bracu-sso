import React from 'react'

function PasswordReset() {
    const cardStyle = {
        borderRadius: '25px',
    }

    return (
        <div>
            <div className="card py-0" style={ cardStyle }>
                <div className="card-body pb-1 pt-3">
                    <div className="row">
                        <div className="col-md-6 mb-2 pr-0">
                            <input type="password" className="form-control left-col" placeholder="Current Password" />
                        </div>
                        <div className="col-md-6 mb-2 pl-0">
                            <input type="password" className="form-control right-col" placeholder="New Password" />
                        </div>
                        <div className="col-md-6 mb-2 pr-0">
                            <input type="password" className="form-control left-col" placeholder="Confirm Password" />
                        </div>
                        <div className="col-md-6 mb-2 pl-0">
                            <button type="submit" className="btn btn-dark w-100 right-col">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default PasswordReset
