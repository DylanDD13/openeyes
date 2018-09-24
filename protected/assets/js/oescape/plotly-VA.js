function setYAxis_VA(options) {
  return {
    side: 'right',
    title: '',
    range: options['range'],
    /* Grid line settings of yaxis */
    showgrid: true,
    gridwidth: 0.25,
    gridcolor: '#8c8c8c',

    /*Ticks setting of yaxis*/
    ticks: 'outside',
    showticklabels: true,
    tickvals: options['tickvals'],
    ticktext: options['ticktext']
  };
}