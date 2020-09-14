import React, { Component } from 'react'
import ProfileInfo from './ProfileInfo'
import PasswordReset from './PasswordReset'
import UserLog from './UserLog'


class Dashboard extends Component {
    constructor(props) {
        super(props)
        let logs = [];

        for (let i = 1; i <=  10 + Math.floor(Math.random() * Math.floor(100)); i++) {
            let number =1 + Math.floor(Math.random() * Math.floor(9))
            logs.push({
                id: i,
                name: `App Name ${ number }`,
                rURL: `https://redirect.${ number }/redirect`,
                dateTime: Date().toString()
            })
        }

        this.state = {
            name: 'Username',
            email: 'email@address.tld',
            status: 'Active',
            logs: logs
        }
    }

    handleStatusToggle = () => {
        this.setState({status: this.state.status == 'Active' ? 'Inactive' : "Active"});
    }

    render() {
        let logs = this.state.logs.map(log => <UserLog appName={log.name} rURL={log.rURL} dateTime={log.dateTime} key={log.id} />)
        const cardStyle = {
            borderRadius: '25px',
            maxHeight: '50vh',
            overflowY: 'auto'
        }

        return (
            <div>
                <h4>Dashboard</h4>
                <div className="row mb-3">
                    <div className="col-md-6">
                        <ProfileInfo name={ this.state.name } email={ this.state.email } status={ this.state.status } toggler={ this.handleStatusToggle } />
                    </div>
                    <div className="col-md-6">
                        <PasswordReset />
                    </div>
                </div>
                <div className="row">
                    <div className="col-md-12">
                        <h4>Access Logs</h4>
                        <div className="card" style={ cardStyle }>
                            <div className="card-body">
                                { logs }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default Dashboard
