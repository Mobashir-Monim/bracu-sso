import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch, useLocation } from 'react-router-dom'
import { AnimatedSwitch } from 'react-router-transition'
import Header from './Nav/Nav'
import SideNav from './SideNav/SideNav'
import Dashboard from './Dashboard/Dashboard'
import ResourceGroups from './ResourceGroup/ResourceGroups'
import ResourceGroup from './ResourceGroup/ResourceGroup'
import Scope from './Scope/Scopes'
import User from './User/User'
import RolePermission from './RolePermission/RolePermission'


class App extends Component {
    constructor(props) {
        super(props)
    
        this.state = {
             snav: true
        }
    }
    
    toggleSideNav = () => {
        this.setState({
            snav: !this.state.snav
        })
    }

    render () {
        return (
            <BrowserRouter>
                <Header toggler={this.toggleSideNav} />
                <div className="container-fluid">
                    <div className="row">
                        {this.state.snav && <SideNav />}
                        <main role="main" className={`${this.state.snav ? "col-md-9 col-lg-10" : "col-md-12 col-lg-12"} ml-sm-auto px-md-4 pt-4`} id="main">
                        <AnimatedSwitch
                            atEnter={{ opacity: 0 }}
                            atLeave={{ opacity: 0 }}
                            atActive={{ opacity: 1 }}
                            className="switch-wrapper"
                            >
                                <Route path="/" exact component={ Dashboard } />
                                <Route path="/rgroups" exact component={ ResourceGroups } />
                                <Route path="/rgroups/:id" component={ ResourceGroup } />
                                <Route path="/scopes" component={ Scope } />
                                <Route path="/users" component={ User } />
                                <Route path="/rp" component={ RolePermission } />
                            </AnimatedSwitch>
                        </main>
                    </div>
                </div>
            </BrowserRouter>
        )
    }
}

ReactDOM.render(<App />, document.getElementById('app'))