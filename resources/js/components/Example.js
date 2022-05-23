import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Example extends Component {
  constructor(props){
      super(props);
      console.log('data from component', JSON.parse(this.props.data));
  }
  render() {
      return (
          <div className="container">
            remmmm
          </div>
      );
  }
}  

if (document.getElementById('example')) {
   var data = document.getElementById('example').getAttribute('data');
   ReactDOM.render(<Example data={data} />, document.getElementById('example'));
}