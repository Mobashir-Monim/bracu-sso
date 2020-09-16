import React, { Component } from 'react'
import Scope from './Scope'
import Create from './Create'
import { Link } from 'react-router-dom'

class Scopes extends Component {
    constructor(props) {
        super(props)
        let scopes = []

        for (let i = 0; i < 10 + Math.floor(Math.random() * Math.floor(100)); i++) {
            let info = ''

            for (let z = 0; z < 1 + Math.floor(Math.random() * Math.floor(10)); z++) {
                if (z == 0) {
                    info = `App ${ 1 + Math.floor(Math.random() * Math.floor(300)) }`
                } else {
                    info += `, App ${ 1 + Math.floor(Math.random() * Math.floor(300)) }`
                }
            }

            scopes.push({
                id: i,
                name: `scope ${ i }`,
                description: `description of ${ i }`,
                info: info,
            })
        }
    
        this.state = {
             scopes: scopes
        }
    }
    

    render() {
        let zeroBR = {
            borderRadius: '0px'
        }

        let cardBodyStyle = {
            maxHeight: '70vh',
            overflowY: 'scroll',
            borderRadius: '0px'
        }

        let scopes = this.state.scopes.map(scope => <Link to={`/scopes/${ scope.id }`} className="no-a"><Scope name={ scope.name } description={ scope.description } info={ scope.info } key={ scope.id } /></Link>)

        return (
            <div className="row">
                <div className="col-md-12">
                    <div className="row mb-4">
                        <div className="col-md-8 my-auto"><h4 className="mb-0">Scopes</h4></div>
                        <div className="col-md-4 my-auto">
                            <input type="text" placeholder="Search for Scope" className="form-control" />
                        </div>
                    </div>
                    <div className="card" style={ zeroBR }>
                        <div className="card-header bg-dark text-white" style={ zeroBR }>
                            <Scope name="Name" description="Description" info="Apps with access" hItem={ true } />
                        </div>
                        <div className="card-body py-0" style={ cardBodyStyle }>
                            { scopes }
                        </div>
                    </div>
                    <button className="btn add-btn btn-dark" data-toggle="modal" data-target="#scope-create"></button>
                    <Create />
                </div>
            </div>
        )
    }
}

export default Scopes
