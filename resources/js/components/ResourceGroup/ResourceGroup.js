import React, { Component } from 'react'
import GroupCard from './GroupCard'

class ResourceGroup extends Component {
    render() {
        let searchInputStyle = {
            borderRadius: '25px',
        }

        let buttonStyle = {
            borderRadius: '25px',
            width: '40px',
            height: '40px',
            transformOrigin: '50% 50% 0',
            padding: '0px'
        }

        return (
            <div>
                <div className="row mb-3">
                    <div className="col-md-12 my-auto"><h4 className="mb-0">Resource Groups</h4></div>
                </div>
                <div className="row mb-4">
                    <div className="col-md-4 offset-md-8 my-auto">
                        <input type="text" style={ searchInputStyle } placeholder="Search for Resource Groups" className="form-control" />
                    </div>
                </div>
                <div className="row">
                    <div className="col-md-12">
                        <GroupCard image="https://blog.hubspot.com/hubfs/image8-2.jpg" name="Google" />
                        <GroupCard image="https://i2.wp.com/logosandtypes.com/wp-content/uploads/2019/08/formstack.png?fit=2000%2C2000&ssl=1" name="Formstack" />
                        <GroupCard image="https://d39w7f4ix9f5s9.cloudfront.net/dims4/default/e194fde/2147483647/strip/true/crop/840x630+180+0/resize/1600x1200!/quality/90/?url=http%3A%2F%2Famazon-blogs-brightspot.s3.amazonaws.com%2F40%2Fb0%2F16d665224675bf7ecf4431d1e9ca%2Faws-logo-smile-1200x630.png" name="AWS" />
                    </div>
                </div>
                <button className="btn add-btn btn-dark" data-toggle="tooltip" data-placement="left" title="Add a new Resource"></button>
            </div>
        )
    }
}

export default ResourceGroup
