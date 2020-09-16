import React from 'react'

function Create() {
    return (
        <div className="modal fade" id="scope-create" tabIndex="-1" role="dialog" aria-labelledby="scope-create-title" aria-hidden="true">
            <div className="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="scope-create-title">Create New Scope</h5>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div className="modal-body">
                    <form id="scope-create-form">
                        <div className="row form-group">
                            <div className="col-md-12">
                                <input type="text" className="form-control" placeholder="Scope Name" id="scope-name" />
                            </div>
                        </div>
                        <div className="row form-group">
                            <div className="col-md-12">
                                <textarea className="form-control" id="scope-description" placeholder="Scope Description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div className="modal-footer">
                    <button type="button" className="btn btn-secondary cancel-btn" data-dismiss="modal"></button>
                    <button type="button" className="btn btn-primary tick-btn"></button>
                </div>
                </div>
            </div>
        </div>
    )
}

export default Create
