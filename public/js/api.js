/**
 * API endpoints will be sent to the server
 */

const API_ENDPOINTS = {
    REGISTER:    '/register',

    IMFEELINGLUCKY: '/imfeelinglucky',
    HISTORY:        '/history',
};

/**
 * API module wich contains methods to send requests to the server
 */

const API = {
    /**
     * Headers, will be sent with every request
     * 
     * @type {object}
     * @private
     */
    _headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },

    /**
     * Base url, will be prepended to all requests
     * 
     * @type {string}
     * @private
     */
    _baseUrl: '/ajax',

    /**
     * Method to send GET request
     * 
     * @param {string} url
     * @param {object} data
     * @returns {Promise<any>}
     */
    get: function (url, data) {
        // Add query string to url
        if (data || data !== undefined) {
            url += '?' + this._objectToQueryString(data);
        }
        
        return fetch(this._baseUrl + url, {
            method: 'GET',
            headers: this._headers
        })
        .then(response => response.json())
        .then(response => this._checkStatus(response))
        .catch(error => console.error('Error:', error));
    },
    
    /**
     * Method to send POST request
     * 
     * @param {string} url
     * @param {object} data
     * @returns {Promise<any>}
     */
    post: function (url, data) {
        return fetch(this._baseUrl + url, {
            method: 'POST',
            headers: this._headers,
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(response => this._checkStatus(response))
        .catch(error => console.error('Error:', error));
    },
    
    /**
     * Method to send PUT request
     * 
     * @param {string} url
     * @param {object} data
     * @returns {Promise<any>}
     */
    put: function (url, data) {
        return fetch(this._baseUrl + url, {
            method: 'PUT',
            headers:  this._headers,
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(response => this._checkStatus(response))
        .catch(error => console.error('Error:', error));
    },

    /**
     * Method to send PATCH request
     * 
     * @param {string} url
     * @param {object} data
     * @returns {Promise<any>}
     */
    patch: function (url, data) {
        return fetch(this._baseUrl + url, {
            method: 'PATCH',
            headers:  this._headers,
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(response => this._checkStatus(response))
        .catch(error => console.error('Error:', error));
    },
    
    /**
     * Method to send DELETE request
     * 
     * @param {string} url
     * @returns {Promise<any>}
     */
    delete: function (url) {
        return fetch(this._baseUrl + url, {
            method: 'DELETE',
            headers: this._headers,
        })
        .then(response => response.json())
        .then(response => this._checkStatus(response))
        .catch(error => console.error('Error:', error));
    },

    /**
     * Convert object to query string
     * 
     * @param {object} obj
     * @returns {string}
     * @private
     */
    _objectToQueryString: obj => {
        return Object.keys(obj)
        .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(obj[key])}`)
        .join('&');
    },

    /**
     * Check response status
     * 
     * @param {object} response
     * @returns {object}
     * @private
     */
    _checkStatus: response => {
        if (response.status === 'success') {
            return response.data || response.message;
        } else {
            alert(response.message || 'Something went wrong');
            return null;
        }
    }
};
