import React from 'react'

function Create() {
    return (
        <div className="modal fade" id="rg-create" tabIndex="-1" role="dialog" aria-labelledby="rg-create-title" aria-hidden="true">
            <div className="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="rg-create-title">Create New Resource Group</h5>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div className="modal-body">
                    <form id="rg-create-form">
                        <div className="row form-group">
                            <div className="col-md-12">
                                <input type="text" className="form-control" placeholder="Resource Group Name" id="rg-name" />
                            </div>
                        </div>
                        <div className="row form-group">
                            <div className="col-md-12">
                                <textarea className="form-control" id="rg-description" placeholder="Resource Group Description"></textarea>
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
