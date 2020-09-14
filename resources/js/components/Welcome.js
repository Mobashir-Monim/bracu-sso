import React, { Component } from 'react'
import axios from 'axios'

export class Welcome extends Component {
    createClient = () => {
        const data = {
            name: 'Client Name',
            redirect: 'http://example.com/callback'
        };
        axios.defaults.headers.common = {'Authorization': `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5MTc4NzA5Yi00ZTY1LTQ5NTItODAxYi1kYzIxZmQ5ZDQ4MDMiLCJqdGkiOiJmMGE3YmExYjQ3OTI4NGViM2QyNWVmMTk2YmEzYjM4YmM4YjhjNjFjNjJhMWExN2ZhY2JhYzg3NjljZGIyNzQyN2VhYWYzMDA3MjExZGUyNiIsImlhdCI6MTU5OTQ2OTc1NSwibmJmIjoxNTk5NDY5NzU1LCJleHAiOjE2MzEwMDU3NTUsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.PMaRckV42zGVvcWdoJodJnvgiRRd1nijvUbFttm-VsSV9uCjoGJIrZCKuJJkBsnuj3uRs3Opg1X78qdbHcFsS0QTaot-vLWA64SJ9mdVEVTVQA7y1hUt1xKURRND52jLLtguU-Ut-BrpslWBBtPCORgouSZH6dlokJK8N0rFq7LKQxmy8XvujnpfhP8xwJ7LkOZcCBBj6lyNCwAbMM9x5lWT5Z_YAqeE-hUkiF7h6rjGFj_2BbUOtYOsit0vk21j1CRG7nxlEOEzItl93WPomySE7NijZE083arAckq2pHx_58NNSxW_5cfIO3H8iYJWZffSH5YXnfSA_UnCwHxRbhCWEiRu9jMTmRDCfPxTaCp7UEx66eEt4rw0s-nUeiloytUCp0RCXZT18FFpHtu76VRhf5j3VNXqWemj4EAz4lJVz1SuSKC_tdBI9QmQBQllMbx8paOj_ljpLI_eQKw2cFjh7d8GKK3TarUwaUe9yWxml9_7atA2zsbz8CmuwDhOtpHoMl72UwqnRaZUobDcYP5JhuF0l0M4wl_jVYExY5tjJ0_iZdLqUe9ff8UTfg7Zaa9wFx0AZ1WnHaHM2wflemxG9r9Vv4IB87c_xM3E4mTqrW62xAwai8VsWwzMQu6c3vQ1BfzTI7l5tYFP9Qr5MPepom4K0-Yqs2O4aHxx1Qc`}
        axios.post('/oauth/clients', data)
            .then(response => {
                console.log(response.data);
            })
            .catch (response => {
                // List errors on response...
            });
    }
    
    render() {
        return (
            <div>
                <h1 className="text-center">Yao {this.props.name}</h1>
                <button onClick={this.createClient} className="btn btn-primary w-100">Test client creation</button>
            </div>
        )
    }
}

export default Welcome
