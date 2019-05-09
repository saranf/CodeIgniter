<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 * PHP를위한 오픈 소스 애플리케이션 개발 프레임 워크 입니다.
 * 
 * This content is released under the MIT License (MIT)
 * 이 콘텐츠 버전은 MIT 라이센스를 따릅니다.
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), 
 * 이 소프트웨어 및 관련 문서 파일 (이하 "소프트웨어")의 사본을 얻는 모든 사람에게 사용 권한이 무료로 부여되며,
 * 
 * to deal in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, 
 * 본 소프트웨어를 사용, 복사, 수정, 병합, 게시, 배포, 재 라이센스 및 / 또는 판매 할 수있는 권리를 포함하되 이에 국한되지 않고 제한없이 소프트웨어를 취급합니다
 * 
 * and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 소프트웨어가 제공된 사람이 다음 조건을 충족 할 수 있도록 허용합니다
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 저작권 고지 및 허가 고지는 소프트웨어의 모든 사본에서  중요한 부분입니다.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * 이 소프트웨어는 상품성의 보증을 포함하여 (단, 이에 한하지 않음) 명시 적이거나 묵시적인 어떤 종류의 보증도없이 "있는 그대로"제공됩니다.
 * 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 저작자 또는 저작권 보유자는 소프트웨어 사용과 관련하여 발생했거나 또는 기타 행위로 인해 발생한 청구, 기타 책임에 대해 책임을 지지 않습니다.
 * 
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT 
 * 어플리케이션 환경 
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 * 현재 환경에 따라 다른 구성을 로드 할 수 있습니다. 
 * 환경 설정은 로깅 및 오류보고와 같은 영향을 미칠 수 있습니다.
 * 
 * This can be set to anything, but default usage is:
 * 이것은 무엇이든 설정할 수 있지만 기본 사용법은 다음과 같습니다 :
 * 
 *     development :개발 
 *     testing :테스트
 *     production :생산 
 *
 * NOTE: If you change these, also change the error_reporting() code below
 * 노트 : 이들을 변경하는 경우 아래의 error_reporting()  코드도 변경 하십시오
 */
	define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
//기본적으로 제공되는 $_SERVER['CI_ENV']의 값을 사용하며 그렇지 않으면 'development'로 설정되어 있습니다.
//$_SERVER['CI_ENV']상수는 .htaccess 파일에 정의 될 수 있고, 다른 방법으로는 nginx나 다른 서버로 가능합니다.

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 * 버그 보고서 
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * 서로 다른 환경에서는 다양한 레벨의 오류보고가 필요합니다.
 * 
 * By default development will show errors but testing and live will hide them.
 * 기본적으로 개발시 오류를 보여줄 것입니다. 하지만 테스트 및 실행은 오류를 표시합니다.
 */
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1); //Report all PHP errors
		ini_set('display_errors', 1);//에러의 표시 여부를 조절할 경우
// string ini_set (string $varname (설정의 이름), staring $newvalue(설정의 값)) 이 함수가 포함된 페이지가 사용될 때만 활성화 된다.  
	break;
//에러 보고 ENVIRONMENT 상수를 development로 표시하면 모든 php 오류가 발생할 때 브라우져에 표시됩니다.

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
	break;
//에러 보고 ENVIRONMENT 상수를 production 으로 설정하면 오류를 표시하지 않습니다.

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
//요청을 처리할 준비가 되지 않았습니다.
		echo 'The application environment is not set correctly.';
//응용 프로그램 환경이 제대로 설정되지 않았습니다.
		exit(1); // EXIT_ERROR
}

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 * 시스템 폴더 이름
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * 현재 "system" 폴더의 이름을 이곳에 작성하십시오.
 * 
 * Set the path if it is not in the same directory as this file.
 * 같은 폴더 안에 이 파일이 없으면 경로를 작성하십시오 
 */
	$system_path = 'system';
// system 폴더가 / 폴더에 없으면 $system_path 변수에 작성하십시오 

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 * 어플리케이션 폴더 이름
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here.
 * 이 전면 컨트롤러에서 기본 폴더가 아닌 다른 어플리케이션 폴더를 선택 하려면 이곳에서 해당 이름을 설정하십시오
 * 
 * The directory can also be renamed or relocated anywhere on your server. 
 * 이 폴더는 이름을 바꿀수 있고 또한 당신의 서버 어디에나 다시 배치시킬 수 있습니다.
 * 
 * If you do, use an absolute (full) server path.
 * 만약 당신이 하고 싶다면 완전한 서버 절대 경로를 사용하십시오
 * 
 * For more info please see the user guide:
 * 더 많은 정보를 얻기 원하신다면 사용자 가이드를 보십시오
 * 
 * https://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 * 
 */
	$application_folder = 'application';
//applicaton 폴더가 /안에 없으면 해당 변수를 

/*
 *---------------------------------------------------------------
 * VIEW DIRECTORY NAME
 * view  폴더 이름 
 *---------------------------------------------------------------
 *
 * If you want to move the view directory out of the application
 * directory, set the path to it here. 
 * 만약 당신이 view 폴더를 어플리케이션 폴더 밖으로 이동하고 싶다면 경로를 이곳에 다시 설정하십시오.
 *
 * The directory can be renamed and relocated anywhere on your server. 
 * 이 폴더는 이름을 바꿀수 있고 당신의 모든 서버에 배치할 수 있습니다.
 * 
 * If blank, it will default to the standard location inside your application directory.
 * 만약 비어 있으면 어플리케이션 폴더 안에 있는 표준 위치로 설정 될 것입니다.
 * 
 * If you do move this, use an absolute (full) server path.
 * 만약 당신이 이동하고 싶다면 절대 경로를 사용 하십시오
 *
 * NO TRAILING SLASH!
 */
	$view_folder = '';


/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * 기본 컨트롤러 
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * 보통은 당신은 기본 컨트롤러를 routes.php파일 안에 셋팅 해 놓을 것 입니다.
 * 
 * You can, however, force a custom routing by hard-coding a specific controller class/function here.
 * 그러나 여기서 특정 컨트롤러 클래스/기능을 하드코딩하여 사용자 정의 라우팅을 강제 적용할 수 있다.
 * 
 * For most applications, you WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 * 대부분의 애플리케이션의 경우 여기서 라우팅을 설정할 수는 없지만, 
 * 공통 CI 설치를 공유하는 특정 전면 컨트롤러에서 표준 라우팅을 재정의할 수 있는 특별한 인스턴스에 대한 옵션입니다.
 *
 * IMPORTANT: If you set the routing here, NO OTHER controller will be
 * callable. 
 * 중요함 : 당신이 라우팅을 여기서 셋팅 한다면 , 다른 컨트롤러는 호출 할수 없습니다.
 * 
 * In essence, this preference limits your application to ONE specific controller.
 * 본질적으로 이 기본 설정은 응용 프로그램을 특정 컨트롤러 1개로 제한한다.
 * 
 * Leave the function name blank if you need to call functions dynamically via the URI.
 * URI를 통해 동적으로 기능을 호출해야 하는 경우 기능 이름을 비워 두십시오.
 * 
 * Un-comment the $routing array below to use this feature
 * 이 기능을 사용하려면 아래의 $routing 배열을 해제하십시오.
 */
	// The directory name, relative to the "controllers" directory.  Leave blank
	//"컨트롤러" 디렉토리에 상대적인 디렉토리 이름. 비워두십시오.
	// if your controller is not in a sub-directory within the "controllers" one
	// controller가 "controllers"의 하위 디렉터리에 있지 않은 경우
	// $routing['directory'] = '';

	// The controller class file name.  Example:  mycontroller
	// 컨트롤러 클래스 파일 이름. 예: my controller
	// $routing['controller'] = '';

	// The controller function you wish to be called.
	// 호출할 컨트롤러 기능.
	// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 *  사용자 정의 설정 값 
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. 
 * 아래의 $assign_to_config 배열은 초기화될 때 구성 클래스로 동적으로 전달됩니다.. 
 * 
 * This allows you to set custom config items or override any default config values found in the config.php file.
 * 이를 통해 사용자 정의 구성 항목을 설정하거나 config.php 파일에 있는 기본 구성 값을 재정의할 수 있습니다.
 * 
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 * 이 기능은 여러 개의 전면 컨트롤러 파일 간에 하나의 응용 프로그램을 공유하며 각 파일마다 다른 구성 값을 포함하므로 유용할 수 있습니다.
 * 
 * Un-comment the $assign_to_config array below to use this feature
 * 이 기능을 사용하려면 아래의 $assign_to_config 배열을 해제하십시오.
 */
	// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// 사용자 연결 설정의 끝. 이 줄 아래를 읽지 마십시오.
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 *  시스템 경로를 해결하여 신뢰성 향상
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
	// CLI 요청에 대해 현재 디렉터리를 올바르게 설정하십시오.
	if (defined('STDIN'))
		// 'STDIN' 의 상수가 등록되어 있다면
	{
		chdir(dirname(__FILE__));
		//  "__FILE__" : 심볼릭 링크를 통해 해석된 경우를 포함한 파일의 전체 경로와 이름
		// "dirname()" :  상위 디렉토리의 경로(즉, 현재 디렉토리에서 레벨 업)에 사용된다.
		// "chdir()" : 작업디렉토리를 변경하는 PHP 함수
		// 즉 현재 디렉토리에서 상위 디렉토리로 레벨 업 한다음에 작업 디렉토리를 변경 하는 것이다.
	}

	if (($_temp = realpath($system_path)) !== FALSE)
		//realpath()는 path로 입력된 경로에서 모든 심볼릭 링크와 '/./', '/../'로 참조된 경로 그리고 그 외의 '/' 을 확장해서 표준화된 절대 경로명을 반환합니다. 
		//이렇게 해서 나온 경로명은 심볼릭 일크와 '/./' 또는 '/../' 등을 포함하고 있지 않습니다.
	{
		$system_path = $_temp.DIRECTORY_SEPARATOR;
		//DIRECTORY_SEPARATOR 란
		//유닉스 계열에서 /를 의미하고, 윈도우에서 ￦를 의미하는 상수다. 
		//파일 경로 적을 때 사실 뭐 그냥 /라고 써도 윈도우에서 잘 되긴 한다.
	}
	else
	{
		// Ensure there's a trailing slash
		// 후행 슬래쉬가 있는지 확인
		$system_path = strtr(
			rtrim($system_path, '/\\'),
			'/\\',
			// strtr 함수는 chars를 하나씩 번역한다는 것을 의미합니다.
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		).DIRECTORY_SEPARATOR;
	}

	// Is the system path correct?
	// 시스템 경로가 올바른가?
	if ( ! is_dir($system_path))
		//is_dir() 함수는 지정된 파일이 디렉터리인지 여부를 확인한다.
		//이 함수는 디렉토리가 존재하면 TRUE를 반환한다.
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		//header 함수는 가공하지 않은 http 를 송신할 때 보내는 함수 이다.
		
		echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// Path to the system directory
	define('BASEPATH', $system_path);

	// Path to the front controller (this file) directory
	define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

	// Name of the "system" directory
	define('SYSDIR', basename(BASEPATH));

	// The path to the "application" directory
	if (is_dir($application_folder))
	{
		if (($_temp = realpath($application_folder)) !== FALSE)
		{
			$application_folder = $_temp;
		}
		else
		{
			$application_folder = strtr(
				rtrim($application_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
	{
		$application_folder = BASEPATH.strtr(
			trim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}

	define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

	// The path to the "views" directory
	if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.'views';
	}
	elseif (is_dir($view_folder))
	{
		if (($_temp = realpath($view_folder)) !== FALSE)
		{
			$view_folder = $_temp;
		}
		else
		{
			$view_folder = strtr(
				rtrim($view_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.strtr(
			trim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}

	define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
