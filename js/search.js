$(document).ready(function(){
	class Commitment extends React.Component{
		constructor(){
			super();
		}
		render(){
			const value=this.props.comm;

			if(value=="10 hrs/week"){
				return(
					<div className="process-pledged"><span>
						<a data-tooltip="Small team">
						<i className="fa fa-user"></i>
						<i className="fa fa-user"></i></a>
					</span>team size</div>
				);
			}
			else if(value=="11 to 20 hrs/week"){
				return(
					<div className="process-time"><span>
						<a data-tooltip="11 to 20 hrs/week (approx.)">
						<i className="fa fa-clock-o"></i>
						<i className="fa fa-clock-o"></i></a>
					</span>involvement</div>
				);

			}
			else if(value=="21 to 30 hrs/week"){
				return(
					<div className="process-time"><span>
						<a data-tooltip="21 to 30 hrs/week (approx.)">
						<i className="fa fa-clock-o"></i>
						<i className="fa fa-clock-o"></i>
						<i className="fa fa-clock-o"></i></a>
					</span>involvement</div>
				);
			}
			return(
				<div className="process-time"><span>
					<a data-tooltip="> 31 hrs/week (approx.)">
					<i className="fa fa-clock-o"></i>
					<i className="fa fa-clock-o"></i>
					<i className="fa fa-clock-o"></i>
					<i className="fa fa-clock-o"></i></a>
				</span>involvement</div>
			);
		}
	}

	class TeamSize extends React.Component{
		constructor(){
			super();
		}
		render(){
			const value=this.props.team;

			if(value=="Small"){
				return(
					<div className="process-pledged"><span>
						<a data-tooltip="Small team">
						<i className="fa fa-user"></i>
						<i className="fa fa-user"></i></a>
					</span>team size</div>
					);
			}
			else if(value=="Medium"){
				return(
					<div className="process-pledged"><span>
						<a data-tooltip="Medium team">
						<i className="fa fa-user"></i>
						<i className="fa fa-user"></i>
						<i className="fa fa-user"></i></a>
					</span>team size</div>
					);
			}
			else if(value=="Large"){
				return(
					<div className="process-pledged"><span>
						<a data-tooltip="Large team">
						<i className="fa fa-user"></i>
						<i className="fa fa-user"></i>
						<i className="fa fa-user"></i>
						<i className="fa fa-user"></i></a>
					</span>team size</div>
					);
			}
			return(
				<div className="process-pledged"><span>
					<a data-tooltip="Extra large team">
					<i className="fa fa-user"></i>
					<i className="fa fa-user"></i>
					<i className="fa fa-user"></i>
					<i className="fa fa-user-plus"></i></a>
				</span>team size</div>
				);
		}
	}
	class Filter extends React.Component{
		constructor(props){
			super(props);
			this.state={
				data: this.props.data,
			}
		}
		involve(highToLow){
			console.log("here");
			var arr=this.state.data.map((x,i) =>{
				if (x.time=="10 hrs/week"){
					return [1, i];
				}
				else if (x.time=="11 to 20 hrs/week"){return [2, i];}
				else if (x.time=="21 to 30 hrs/week"){return [3, i];}
				else {return [4, i];}
			});
			if (highToLow) {arr.sort((a,b) => {return b[0]-a[0];})}
			else{arr.sort((a,b) =>{return a[0]-b[0];})}
			var newData=arr.map(x => this.state.data[x[1]]);
			ReactDOM.render(<Layout data={newData}/>,
					document.getElementById('proj-res'));
		}
		size(highToLow){
			console.log("here1");
			var arr=this.state.data.map((x,i) =>{
				if (x.tsize=="Small"){
					return [1, i];
				}
				else if (x.tsize=="Medium"){return [2, i];}
				else if (x.tsize=="Large"){return [3, i];}
				else {return [4, i];}
			});
			if (highToLow) {arr.sort((a,b) => {return b[0]-a[0];})}
			else{arr.sort((a,b) =>{return a[0]-b[0];})}
			var newData=arr.map(x => this.state.data[x[1]]);
			ReactDOM.render(<Layout data={newData}/>,
					document.getElementById('proj-res'));
		}
		alphabet(aToZ){
			console.log("here2");
			var arr=this.state.data.map((x,i) =>[x.projName, i]);
			if(aToZ){
				arr.sort((a,b)	=>	{
					if (a[0].toLowerCase() < b[0].toLowerCase()) {return -1;}
					else if(a[0].toLowerCase() > b[0].toLowerCase()) {return 1;}
					else {return 0;}
				});
			}
			else{
				arr.sort((a,b)	=>	{
					if (a[0].toLowerCase() < b[0].toLowerCase()) {return 1;}
					else if(a[0].toLowerCase() > b[0].toLowerCase()) {return -1;}
					else {return 0;}
				});
			}
			var newData=arr.map(x => this.state.data[x[1]]);
			ReactDOM.render(<Layout data={newData}/>,
					document.getElementById('proj-res'));

		}
		time(newToOld){
			console.log("here3");
			var arr=this.state.data.map((x,i) =>[x.projID, i]);
			if (newToOld){
				arr.sort((a,b)	=>	{return b[0]-a[0];});
			}
			else{
				arr.sort((a,b)	=>	{return a[0]-b[0];});
			}
			
			var newData=arr.map(x => this.state.data[x[1]]);
			ReactDOM.render(<Layout data={newData}/>,
					document.getElementById('proj-res'));
		}
		interest(highToLow){
			console.log("here4");
			var arr=this.state.data.map((x,i) =>[x.subs, i]);
			if (highToLow) {
				arr.sort((a,b)	=>	{return b[0]-a[0];});
				console.log("1");
			}
			else{
				arr.sort((a,b)	=>	{return a[0]-b[0];});
				console.log("2");
			}
			
			var newData=arr.map(x => this.state.data[x[1]]);
			ReactDOM.render(<Layout data={newData}/>,
					document.getElementById('proj-res'));
		}
		render(){
			return(
				<div className="field-select" style={{width: 280}}>
					<ul name="em_ext" id="" style={{marginBottom: 0, borderRadius: 0}}>
						<li value="" >Select a filter</li>
						<li value="" onClick={this.alphabet.bind(this, true)}>Sort by A-Z</li>
						<li value="" onClick={this.alphabet.bind(this, false)}>Sort by Z-A</li>
						<li value="" onClick={this.time.bind(this, true)}>Sort by Newest-Oldest</li>
						<li value="" onClick={this.time.bind(this, false)}>Sort by Oldest-Newest</li>
						<li value="" onClick={this.size.bind(this, true)}>Sort by Team Size [High to Low]</li>
						<li value="" onClick={this.size.bind(this, false)}>Sort by Team Size [Low to High]</li>
						<li value="" onClick={this.involve.bind(this,false)}>Sort by Involvement [High to Low]</li>
						<li value="" onClick={this.involve.bind(this,false)}>Sort by Involvement [Low to High]</li>
						<li value="" onClick={this.interest.bind(this,true)}>Sort by Interest [High to Low]</li>
						<li value="" onClick={this.interest.bind(this,false)}>Sort by Interest [Low to High]</li>
					</ul>
				</div>
			);
		}
	}

	class Project extends React.Component{
		constructor(props){
			super(props);
			this.state={
				id: this.props.json.subs,
			};
		}
		updateCounter(id){
			var self=this;
			$.ajax({
				url: 'https://slkgm2z32g.execute-api.us-east-1.amazonaws.com/production/teamwerk/API/inter?id='+String(id),
				headers: {'X-API-KEY': apiKey},
				type: 'GET',
				crossDomain: true,
				dataType: 'json',
				tryCount: 0,
				retryLimit: 4,
				success: function(data){
					self.setState({id: data.count});
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);

					this.tryCount++;
					if(this.tryCount<=this.retryLimit){
						$.ajax(this);
						return;
					}
				}
			});
		}
		render(){
			let projDetails=this.props.json;
			setTimeout(() =>{
				this.updateCounter(projDetails.projID);
			}, 30000);
			
			return(
				<div className="col-lg-4 col-sm-6 col-6" data-id2={String(projDetails.projID)}>
					<div className="campaign-item wow fadeInUp" data-wow-delay=".1s">
						<a className="overlay content" style={{height: 240}} href={"project.php?projID="+String(projDetails.projID)}>
							<img src={projDetails.small_ban} style={{height: 240}} />
							<span className="ion-paper-airplane"></span>
						</a>
						<div className="campaign-box">
							<a href="#" className="category">{projDetails.catName}</a>
							<h3><a className="content" href={"project.php?projID="+String(projDetails.projID)}>{projDetails.projName}</a></h3>
							<div className="campaign-description">{projDetails.sm_desc}</div>
							<div className="campaign-author"><a className="author-icon" href={"profile.php?other_usr="+String(projDetails.usrID)}>
								<img src={projDetails.profilepic} /></a>by <a className="author-name" href={"profile.php?other_usr="+projDetails.usrID}>{projDetails.firstname}		
							</a></div>
							<div className="process">
								<div className="raised"><span style={{width: projDetails.progress}}></span></div>
								<div className="process-info">
									<div className="process-pledged"><span>
											{this.state.id}
											</span>interest</div>
										<TeamSize team={projDetails.tsize}/>
										<Commitment comm={projDetails.time}/>
								</div>
							</div>
						</div>
					</div>
				</div>

				);
		}
	}



	class Layout extends React.Component{
		constructor(){
			super();
		}
		render(){
			const generateKey=(i) =>{
				return `${i}_${ new Date().getTime() }`;
			}
			var dataArr=this.props.data;
			var projects=dataArr.map((data, index) =><Project key={generateKey(index)} json={data}/>);
			return(
				<div className="row" id="lib-pg">
				{projects}
				</div>
				);
		}
	}
	




















	$.ajax({
		url: 'https://slkgm2z32g.execute-api.us-east-1.amazonaws.com/production/teamwerk/API/project',
		headers: {'X-API-KEY': apiKey},
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify({"search": queryTerm}),
		crossDomain: true,
		dataType: 'json',
		tryCount: 0,
		retryLimit: 4,
		success: function(data){
			if(data.projects.length==0){
				ReactDOM.render(<h1>No results available :(</h1>,
					document.getElementById('proj-res'));
			}
			else{
				let prof=data.projects.map(x =>x.profilepic);
				let bigBan=data.projects.map(x =>x.big_ban);
				let smallBan=data.projects.map(x =>x.small_ban);
			
				generateObject(data.projects, prof, bigBan, smallBan);
			}
			

			
		},
		error: function( jqXHR, textStatus, errorThrown){
			console.log(jqXHR);
			console.log(textStatus);
			console.log(errorThrown);

			this.tryCount++;
			if(this.tryCount<=this.retryLimit){
				$.ajax(this);
				return;
			}
		}
	});

	function generateObject(data, prof, bigBan, smallBan){
		$.ajax({
			url: 'img_url.php',
			type: 'POST',
			data: {
				'profilepic': prof,
				'bigban': bigBan,
				'smallban': smallBan,
			},
			dataType: 'json',
			success: function(json){
				for(var i=0;i < data.length; i++){
					data[i].profilepic=json.profilepic[i];
					data[i].small_ban=json.banner[i];
				}
				ReactDOM.render(<Layout data={data}/>,
					document.getElementById('proj-res'));
				ReactDOM.render(<Filter data={data}/>,
					document.getElementById('filter'));
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
	}

});