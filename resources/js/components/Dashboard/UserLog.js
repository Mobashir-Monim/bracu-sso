import React from 'react'

function UserLog({appName, rURL, dateTime}) {
    return (
        <div>
            <div className="row border-bottom mb-2">
                <div className="col-md-4 my-auto">{appName}</div>
                <div className="col-md-8">
                    <div className="row">
                        <div className="col-md-12 border-bottom">{rURL}</div>
                        <div className="col-md-12">{dateTime}</div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default UserLog
