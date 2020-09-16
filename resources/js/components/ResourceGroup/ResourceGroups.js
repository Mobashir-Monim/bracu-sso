import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import GroupCard from './GroupCard'
import Create from './Create'

class ResourceGroups extends Component {
    constructor(props) {
        super(props)
    
        this.state = {
             rgs: [
                    {
                        id: 1,
                        name: 'Google',
                        image: 'https://blog.hubspot.com/hubfs/image8-2.jpg'
                    },
                    {
                        id: 2,
                        name: 'Formstack',
                        image: 'https://i2.wp.com/logosandtypes.com/wp-content/uploads/2019/08/formstack.png?fit=2000%2C2000&ssl=1'
                    },
                    {
                        id: 3,
                        name: 'AWS',
                        image: 'https://d39w7f4ix9f5s9.cloudfront.net/dims4/default/e194fde/2147483647/strip/true/crop/840x630+180+0/resize/1600x1200!/quality/90/?url=http%3A%2F%2Famazon-blogs-brightspot.s3.amazonaws.com%2F40%2Fb0%2F16d665224675bf7ecf4431d1e9ca%2Faws-logo-smile-1200x630.png'
                    },
             ]
        }
    }
    
    render() {
        let groups = this.state.rgs.map(rg => <Link to={ `/rgroups/${ rg.id }` } key={ rg.id } className="text-left" ><GroupCard image={ rg.image } name={ rg.name } /></Link>);

        return (
            <div>
                <div className="row mb-4">
                    <div className="col-md-8 my-auto"><h4 className="mb-0">Resource Groups</h4></div>
                    <div className="col-md-4 my-auto">
                        <input type="text" placeholder="Search for Resource Groups" className="form-control" />
                    </div>
                </div>
                <div className="row">
                    <div className="col-md-12 text-center">
                        { groups }
                    </div>
                </div>
                <button className="btn add-btn btn-dark" data-toggle="modal" data-target="#rg-create"></button>
                <Create />
            </div>
        )
    }
}

export default ResourceGroups
