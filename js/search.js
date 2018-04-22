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
			var dataArr=this.props.data;
			var projects=dataArr.map((data, index) =><Project key={index} json={data}/>);
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
			let prof=data.projects.map(x =>x.profilepic);
			let bigBan=data.projects.map(x =>x.big_ban);
			let smallBan=data.projects.map(x =>x.small_ban);
			
			generateObject(data.projects, prof, bigBan, smallBan);

			
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
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
	}

});